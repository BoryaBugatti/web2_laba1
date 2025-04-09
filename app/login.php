<?php
session_start();
require "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        try {
            $sql = "SELECT * FROM users WHERE user_email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user["user_password"])) {
                $_SESSION['user_email'] = $user['user_email'];
                $_SESSION['user_role'] = $user['user_role'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['is_authorizated'] = true;

                session_regenerate_id();

                header("Location: index.php"); 
                exit;
            } else {
                echo "<script>alert('Неверный логин или пароль');</script>";
                echo "<script>window.location.href='authorization.php';</script>";
            }
        } catch (Exception $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    } else {
        echo "<script>alert('Поля почта и пароль не могут быть пустыми');</script>";
    }
}