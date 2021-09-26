<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добро пожаловать | Инстаграм</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/templates/css/style.css">
    <style>

    </style>
</head>
<body>
    <div class="container mt-4">
        <h1>Инстаграм</h1>
        <div class="<?php echo $this->new_registration ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="status">
                    Вы успешно зарегистрировались! Войдите в свою учетную запись.
                </span>
            </div>
        </div>
        <form action="/auth" method="post" class="enter">
            <input type="text" class="form-control" name="login" id="login" placeholder="Логин" required value="<?php echo $this->login ?? ''; ?>">
                <div class="<?php echo $this->error_login ?? 'hidden'; ?>">
                    <div class="wrap-error">
                        <span class="warning">
                            <sup>*</sup> Логин не может быть пустым или состоять только из пробелов
                        </span>
                    </div>
                </div>
            <input type="password" class="form-control" name="pass" id="pass" placeholder="Пароль" required value="<?php echo $this->pass ?? ''; ?>">
            <div class="<?php echo $this->error_pass ?? 'hidden'; ?>">
                <div class="wrap-error">
                    <span class="warning">
                        <sup>*</sup> Пароль не может быть пустым или состоять только из пробелов
                    </span>
                </div>
            </div>
            <div class="wrap-button">
                <p class="right">
                    <a href="/register">Зарегистрироваться</a>
                </p>
                <button type="submit" class="btn btn-success">Войти</button>
            </div>
            <div class="<?php echo $this->error_verify ?? 'hidden'; ?>">
                <div class="wrap-error">
                    <span class="warning auth-warning">
                        Не удаётся войти.<br>
                        Пожалуйста, проверьте правильность написания логина и пароля.
                    </span>
                </div>
            </div>
        </form>
    </div>
</body>
</html>