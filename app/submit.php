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
    echo "<a href='index.html'>Вернуться на главную</a>";
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT * FROM appointment";
    if ($result = $conn->query($sql)) {
        foreach($result as $row){
            $appointment_id = $row["appointment_id"];
            $appointment_patient_name = $row["appointment_patient_name"];
            $appointment_doctor_name = $row["appointment_doctor_name"];
            $appointment_date = $row["appointment_date"];
            echo "Id-приема: $appointment_id\n Имя пациента: $appointment_patient_name\n Имя доктора: $appointment_doctor_name\n Дата приема: $appointment_date\n";
        }
    }
    echo "<a href='index.html'>Вернуться на главную</a>";
}
?>