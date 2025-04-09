<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация на прием</title>
    <link rel="stylesheet" href="styles/style.css?v=10.0">
</head>
<body>
    <div class="page-wrapper">
        <header class="header">
            <a href="lk.php">Личный кабинет пользователя</a>
            <h1 class="header-title">Болеешь?</h1>
            <h1 class="header-title">Запишись на прием к врачу</h1>
            <p class="header-subtitle">Введите данные ниже, чтобы записаться на прием</p>
        </header>
        <main class="form-container">
            <div class="form-card">
                <form action="submit.php" method="post" class="registration-form">
                    <div class="form-group">
                        <label for="patient" class="form-label">Пациент:</label>
                        <input type="text" id="patient" name="patient" class="form-input" placeholder="Введите ваше имя" required>
                    </div>
                    <div class="form-group">
                        <label for="doctor" class="form-label">Врач:</label>
                        <input type="text" id="doctor" name="doctor" class="form-input" placeholder="Введите имя врача" required>
                    </div>
                    <div class="form-group">
                        <label for="date" class="form-label">Дата приема:</label>
                        <input type="date" id="date" name="date" class="form-input" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Записаться</button>
                </form>
                <form action="submit.php" method="get" class="secondary-form">
                    <button type="submit" class="btn btn-secondary">Получить данные о приемах</button>
                </form>
            </div>
        </main>
    </div>
    <script src="scripts/scriptforappointment.js"></script>
</body>
</html>
