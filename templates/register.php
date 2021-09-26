<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация | Инстаграм</title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/templates/css/style.css">
    <style>

    </style>
</head>
<body>
<div class="container mt-4">
    <h1>Инстаграм</h1>
    <form action="/register" method="post" class="enter">
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Ваше имя" value="<?php echo $this->first_name ?? ''; ?>">
        <div class="<?php echo $this->error_first_name ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="warning">
                    <sup>*</sup> Имя не может быть пустым или состоять только из пробелов
                </span>
            </div>
        </div>
        <input type="text" class="form-control" name="second_name" id="second_name" placeholder="Ваша фамилия" value="<?php echo $this->second_name ?? ''; ?>">
        <div class="<?php echo $this->error_second_name ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="warning">
                    <sup>*</sup> Фамилия не может быть пустой или состоять только из пробелов
                </span>
            </div>
        </div>
        <input type="email" class="form-control" name="email" id="email" placeholder="Ваш email" value="<?php echo $this->email ?? ''; ?>">
        <div class="<?php echo $this->error_email ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="warning">
                    <sup>*</sup> Email не может быть пустым или состоять только из пробелов
                </span>
            </div>
        </div>
        <div class="<?php echo $this->error_validate_email ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="warning">
                    <sup>*</sup> Пароль записан неверно. Проверьте наличие @ и точек перед доменным именем первого уровня
                </span>
            </div>
        </div>
        <input type="text" class="form-control" name="login" id="login" placeholder="Придумайте логин" value="<?php echo $this->login ?? ''; ?>">
        <div class="<?php echo $this->error_login ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="warning">
                    <sup>*</sup> Логин не может быть пустым или состоять только из пробелов
                </span>
            </div>
        </div>
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Придумайте пароль" value="<?php echo $this->pass ?? ''; ?>">
        <div class="<?php echo $this->error_pass ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="warning">
                    <sup>*</sup> Пароль не может быть пустым или состоять только из пробелов
                </span>
            </div>
        </div>
        <input type="password" class="form-control" name="confirm_pass" id="confirm_pass" placeholder="Повторите пароль" value="<?php echo $this->pass ?? ''; ?>">
        <div class="<?php echo $this->error_pass ?? 'hidden'; ?>">
            <div class="wrap-error">
                <span class="warning">
                    <sup>*</sup> Пароль не может быть пустым или состоять только из пробелов
                </span>
            </div>
        </div>
        <div class="wrap-button">
            <p class="right"><a href="/">Войти</a></p>
            <button type="submit" class="btn btn-success">Зарегистрироваться</button>
        </div>
        <div class="<?php echo $this->error_matching_pass ?? 'hidden'; ?>">
            <div class="wrap-error">
                        <span class="warning auth-warning">
                            Пароли не совпадают.<br>
                            Пожалуйста, попробуйте еще раз.
                        </span>
            </div>
        </div>
    </form>
</div>


</body>
</html>