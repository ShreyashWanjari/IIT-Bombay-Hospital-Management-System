<?php
session_start();

if (getenv('ENVIRONMENT') !== "development") {
    error_reporting(0);
}

include('../../hms/include/config.php');
include_once("../../hms/include/check_login_and_perms.php");

$userType = UserTypeEnum::Doctor->value;

if (!check_login_and_perms($userType)) {
    exit;
}

// Encryption Function

function encryptData($data, $secret)
{
    $keyLength = 32; // 256 bits for AES-256
    $ivLength = 16;  // 128 bits for AES-256-CBC

    // Derive key and IV from the secret using PBKDF2
    // $keyAndIv = hash_pbkdf2("sha256", $secret, 1000, $keyLength + $ivLength, 0, true);
    $keyAndIv = $secret;

    // Separate key and IV
    $key = substr($keyAndIv, 0, $keyLength);
    $iv = substr($keyAndIv, $keyLength, $ivLength);

    $cipher = "aes-256-cbc";
    $options = 0;
    $encryptedData = openssl_encrypt($data, $cipher, $key, $options, $iv);

    return $encryptedData;
}

// Decryption Function (if needed)
function decryptData($encryptedData, $secret)
{
    $keyLength = 32; // 256 bits for AES-256
    $ivLength = 16;  // 128 bits for AES-256-CBC

    // Derive key and IV from the secret using PBKDF2
    // $keyAndIv = hash_pbkdf2("sha256", $secret, 1000, $keyLength + $ivLength, 0, true);
    $keyAndIv = $secret;

    // Separate key and IV
    $key = substr($keyAndIv, 0, $keyLength);
    $iv = substr($keyAndIv, $keyLength, $ivLength);

    $cipher = "aes-256-cbc";
    $options = 0;
    $data = openssl_decrypt($encryptedData, $cipher, $key, $options, $iv);

    return $data;
}

if (isset($_POST['method'])) {

    $password = hex2bin("DD57C8EFF5554F79581217D019066CCAA5E4474E8561AEC848ACF3DAE9AE7A4D34C39AC34163667467D68B1DC183804F");
    $imageBinaryString = base64_decode($_POST['image']);

    // Perform encryption
    if ($_POST['method'] === "enc") {
        $ret = mysqli_execute_query($con, "SELECT nonce from doctors where id = ?", [$_SESSION['id']]);
        $row = mysqli_fetch_array($ret);
        $nonce = $row['nonce']; // 48 bytes

        $timestamp = time();
        $binaryTimestamp = pack('V', $timestamp); // 4 bytes

        $imageBinaryString = $nonce . $binaryTimestamp . $imageBinaryString;
        $imageData = encryptData($imageBinaryString, $password);

        $response = array('imageData' => base64_encode($imageData));
    } else {
        // Perform encryption
        $decryptedData = decryptData($imageBinaryString, $password);

        if (strlen($decryptedData) === 0) {
            http_response_code(400);
            $response = array('error' => "This is not a valid encrypted file.");
            echo json_encode($response);
            exit;
        }

        $nonce = substr($decryptedData, 0, 48);
        $timestamp = substr($decryptedData, 48, 4);
        $imageData = substr($decryptedData, 48 + 4);

        $ret = mysqli_execute_query($con, "SELECT users.fullName from doctors join users on users.id = doctors.id where doctors.nonce = ?", [$nonce]);
        $row = mysqli_fetch_array($ret);

        if ($row === null) {
            http_response_code(400);
            $response = array('error' => "This file was not generated by a valid doctor. Please let us know about this incident.");
            echo json_encode($response);
            exit;
        }

        $response = array('imageData' => base64_encode($imageData), 'doctor' => $row['fullName'], 'timestamp' => unpack('N', $timestamp)[1]);
    }

    echo json_encode($response);
}
