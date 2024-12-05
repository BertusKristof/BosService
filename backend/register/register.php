<?php
session_start();
require_once "../database.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$first_name_error = $last_name_error = $email_error = $password_error = $phone_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $phone = trim($_POST['phone']);

    if (empty($first_name)) {
        $first_name_error = "A vezetéknév megadása kötelező!";
    } 
    if (empty($last_name)) {
        $last_name_error = "A keresztnév megadása kötelező!";
    }
    if (empty($email)) {
        $email_error = "Az email cím megadása kötelező!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Érvénytelen e-mail formátum!";
    } 
    if (empty($password)) {
        $password_error = "A jelszó megadása kötelező!";
    } elseif (strlen($password) < 6) {
        $password_error = "A jelszónak legalább 6 karakter hosszúnak kell lennie!";
    } 
    if (empty($phone)) {
        $phone_error = "A telefonszám megadása kötelező!";
    } elseif (!preg_match('/^(\+36|06)\s?([1-9]{1}[0-9]{1})\s?[0-9]{3}\s?[0-9]{4}$/', $phone)) {
        $phone_error = "Érvénytelen telefonszám formátum! (Pl. +36 30 123 4567 vagy 06 30 123 4567)";
    }

    if (empty($first_name_error) && empty($last_name_error) && empty($email_error) && empty($password_error) && empty($phone_error)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $conn->begin_transaction();

        try {
            $sql_register = "INSERT INTO user_register (first_name, last_name, register_email, register_password, register_phone) VALUES (?, ?, ?, ?, ?)";
            $stmt_register = $conn->prepare($sql_register);
            $stmt_register->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $phone);
            $stmt_register->execute();
            $stmt_register->close();

            $user_id = $conn->insert_id;

            $sql_login = "INSERT INTO user_login (user_id, login_email, login_phone, login_password) VALUES (?, ?, ?, ?)";
            $stmt_login = $conn->prepare($sql_login);
            $stmt_login->bind_param("isss", $user_id,$email, $phone, $hashed_password);
            $stmt_login->execute();
            $stmt_login->close();

            $conn->commit();

            $_SESSION['user_name'] = $first_name . " " . $last_name;
            header("Location: ../index.php");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            $error_message = "Adatbázis hiba: " . $e->getMessage();
        }
    }
}

$conn->close();
?>
