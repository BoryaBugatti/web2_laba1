<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет пользователя</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="priv">
        <?php
        require "db.php";
        if (isset($_SESSION['is_authorizated']) && $_SESSION['is_authorizated'] === true) {
            echo "Вы авторизованы как: " . htmlspecialchars($_SESSION['user_email']);
            echo "<br>Ваша роль: " . htmlspecialchars($_SESSION['user_role']);
            if ($_SESSION['user_role'] == 'Админ') {
                $sql1 = "SELECT * FROM users";
                echo "<h2>Все зарегистрированные пользователи:</h2>";
                if ($result1 = $conn->query($sql1)) {
                    echo "<table>";
                    echo "<tr><th>Имя пользователя</th><th>Почта пользователя</th><th>Роль пользователя</th></tr>";
                    foreach ($result1 as $row1) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row1['user_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row1['user_email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row1['user_role']) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Ошибка при получении данных о пользователях.";
                }
                $sql2 = "SELECT * FROM appointment";
                echo "<h2>Все приемы:</h2>";
                if ($result2 = $conn->query($sql2)) {
                    echo "<table>";
                    echo "<tr><th>Имя пациента</th><th>Имя доктора</th><th>Дата приема</th></tr>";
                    foreach ($result2 as $row2) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row2["appointment_patient_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row2["appointment_doctor_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row2["appointment_date"]) . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "Ошибка при получении данных о приемах.";
                }
            }
        } else {
            echo "<script>alert('Вы не авторизованы');</script>";
            echo "<script>window.location.href='authorization.php'</script>";
        }
        ?>
        <form action="logout.php" method="post">
            <input type="submit" value="Выйти из аккаунта">
        </form>
        <form action="otchet.php" method="post">
            <input type="submit" value="Сделать отчеты">
        </form>
        <a href="index.php">Вернуться назад</a>
    </div>
</body>
</html>