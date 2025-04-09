<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/submitstyle.css">
    <title>Document</title>
</head>
<body>
    <?php
    require "db.php";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['patient']) && isset($_POST['doctor']) && isset($_POST['date'])) {
            $patient = htmlspecialchars(trim($_POST['patient']));
            $doctor = htmlspecialchars(trim($_POST['doctor']));
            $date = date("Y-m-d", strtotime($_POST["date"]));

            if (empty($patient) || empty($doctor)) {
                echo "Ошибка: Поля 'Пациент' и 'Врач' не могут быть пустыми.";
                exit;
            }

            if (preg_match('/\d/', $patient) || preg_match('/\d/', $doctor)) {
                echo "Неправильный формат ввода данных: поля 'Пациент' и 'Врач' не могут содержать числа.";
                exit;
            }

            $currentdate = date("Y-m-d");
            if ($date < $currentdate) {
                echo "Ошибка: Дата не может быть в прошлом";
                exit; 
            } else {
                $filename = "list.csv";
                $f = fopen($filename, 'a');
                $data = "Пациент: $patient, Доктор: $doctor, Дата: $date\n";
                fwrite($f, $data);
                fclose($f);
            }
            try {
                $stmt = $conn->prepare("INSERT INTO appointment (appointment_patient_name, appointment_doctor_name, appointment_date) VALUES (:patient, :doctor, :date)");
                $stmt->bindParam(':patient', $patient);
                $stmt->bindParam(':doctor', $doctor);
                $stmt->bindParam(':date', $date);
                $stmt->execute();

                echo "Запись успешно добавлена.\n";
            } catch (PDOException $e) {
                echo "Ошибка: " . $e->getMessage();
            }
        }
        echo "<a href='inde.php'>Вернуться на главную</a>";
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = "SELECT * FROM appointment";
        if ($result = $conn->query($sql)) {
            echo "<div class='appointment-list'>";
            foreach($result as $row){
                $appointment_id = $row["appointment_id"];
                $appointment_patient_name = $row["appointment_patient_name"];
                $appointment_doctor_name = $row["appointment_doctor_name"];
                $appointment_date = $row["appointment_date"];
                echo "<div class='appointment-card'>";
                echo "<h3>Id-приема: $appointment_id</h3>";
                echo "<p><strong>Имя пациента:</strong> $appointment_patient_name</p>";
                echo "<p><strong>Имя доктора:</strong> $appointment_doctor_name</p>";
                echo "<p><strong>Дата приема:</strong> $appointment_date</p>";
                echo "</div>";
            }
        }
        echo "<a href='index.php'>Вернуться на главную</a>";
    }
    ?>
</body>
</html>