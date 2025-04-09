<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма регистрации и входа</title>
    <link rel="stylesheet" href="styles/regstyle.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-toggle">
                <button id="loginBtn" class="toggle-button active">Вход</button>
                <button id="registerBtn" class="toggle-button">Регистрация</button>
            </div>
            <form id="loginForm" class="form active" action="login.php" method="POST">
                <h2>Вход</h2>
                <div class="form-group">
                    <label for="loginEmail">Email:</label>
                    <input type="email" id="loginEmail" name = "email" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Пароль:</label>
                    <input type="password" id="loginPassword" name = "password" required>
                </div>
                <button type="submit" class="btn">Войти</button>
            </form>

            <form id="registerForm" class="form" action="reg.php" method="post">
                <h2>Регистрация</h2>
                <div class="form-group">
                    <label for="registerName">Имя:</label>
                    <input type="text" id="registerName" name =" user_name" required>
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email:</label>
                    <input type="email" id="registerEmail" name = "user_email" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Пароль:</label>
                    <input type="password" id="registerPassword" name = "user_password" required>
                </div>
                <div class="form-group">
                    <label for="">Введите свою роль на сайте</label>
                    <input type="text" name="user_role" equired>
                </div>
                <button type="submit" class="btn">Зарегистрироваться</button>
            </form>
        </div>
    </div>
    <script src="scripts/authorization.js"></script>
</body>
</html>