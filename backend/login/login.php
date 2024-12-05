<?php
session_start();
require_once "../database.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$login_error = $credential_error = $password_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $credential = trim($_POST['credential']);
    $password = trim($_POST['password']);

    if (empty($credential)) {
        $credential_error = "Az e-mail vagy telefonszám megadása kötelező!";
    }

    if (empty($password)) {
        $password_error = "A jelszó megadása kötelező!";
    }

    if (empty($credential_error) && empty($password_error)) {
        $sql = "SELECT login_email, login_phone, login_password FROM user_login WHERE login_email = ? OR login_phone = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $credential, $credential);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_email, $db_phone, $hashed_password);
            $stmt->fetch();

            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_email'] = $db_email;
                $_SESSION['user_phone'] = $db_phone;
                $_SESSION['user_name'] = $first_name . " " . $last_name;

                header("Location: ../index.php");
                exit();
            } else {
                $login_error = "Helytelen jelszó!";
            }
        } else {
            $login_error = "Az e-mail cím vagy telefonszám nem található!";
        }

        $stmt->close();
    }
}

$conn->close();
?>
