<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->login; ?> | Инстаграм</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/templates/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.5/dist/fancybox.css">
    <style>

    </style>
</head>
<body>
<div class="container mt-4">
    <div class="wrap-link">
        <p class="right">
            <?php echo $this->login; ?> |
            <a href="/auth/logout">Выйти</a>
        </p>
    </div>
    <h1>Инстаграм</h1>
    <form action="/photo" enctype="multipart/form-data" method="post">
        <input name="img" type="file">
        <button type="submit" class="btn btn-success">Загрузить</button>
    </form>
    <div class="<?php echo $this->error_upload ?? 'hidden'; ?>">
        <div class="wrap-error">
            <span class="warning-left auth-warning">
                Не удаётся загрузить файл.
            </span>
        </div>
    </div>
    <div class="<?php echo $this->error_type ?? 'hidden'; ?>">
        <div class="wrap-error">
            <span class="warning-left auth-warning">
                Не удаётся загрузить файл.<br>
                Проверьте, что файл имеет расширение .jpg, .png или .gif
            </span>
        </div>
    </div>
    <div class="<?php echo $this->added_photo ?? 'hidden'; ?>">
        <div class="wrap-error">
            <span class="status">
                Фото загружено!
            </span>
        </div>
    </div>
</div>
<div class="h30"></div>
<div class="row image">
    <?php foreach ($this->photos as $photo) { ?>
    <div class="col-lg-1 col-md-1 col-6">
        <div class="wrap-photo">
            <a href="<?php echo '/' . $photo->full_name; ?>" data-fancybox="gallery">
                <img class="img-fluid" src="<?php echo '/' . $photo->preview_full_name; ?>" alt="">
            </a>
            <form action="/photo/delete" method="post" class="form-delete">
                <button class="delete" type="submit" name="delete" value="<?php echo $photo->id; ?>">
                    <span class="delete-button">x</span>
                </button>
            </form>
        </div>

    </div>
    <?php } ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.5/dist/fancybox.umd.js"></script>
</body>
</html>