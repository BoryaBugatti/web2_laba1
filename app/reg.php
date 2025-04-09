<?php
require "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST["user_name"]) && isset($_POST["user_email"]) && isset($_POST['user_password']) && isset($_POST['user_role'])){
        $user_name = htmlspecialchars(trim($_POST["user_name"]));
        $user_email = htmlspecialchars(trim($_POST["user_email"]));
        $user_password = htmlspecialchars(trim($_POST["user_password"]));
        $user_role = htmlspecialchars(trim($_POST["user_role"]));
        if (empty($username) || empty($user_email) || empty($user_password) || empty($user_role)){
            echo "<script>alert('Все поля должны быть заполнены')</script>";
            exit();
        }
        $hash = password_hash($user_password, PASSWORD_DEFAULT);
        try {
            $stmt = $conn->prepare("INSERT INTO users ( user_email, user_name, user_password, user_role) VALUES (:user_email, :user_name, :user_password, :user_role)");
            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':user_password', $hash);
            $stmt->bindParam(':user_role', $user_role);
            $stmt->execute();
            echo "
                <script>
                    alert('Запись успешно добавлена');
                    window.location.href = 'index.php';
                </script>
            ";
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage();
        }
    }
}