<?php
/**
 * @var \lib\View $this
 */
?>
<html lang="ru-RU">
<head>
    <title><?= $this->title ?></title>
    <?php $this->registerCssFile('main') ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script
        src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"
    ></script>
    <script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"
    ></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="navbar-collapse collapse justify-content-between">
            <a class="navbar-brand" href="/">Телефонная книга</a>
            <ul class="navbar-nav ml-auto">
                <?php if ($this->isAuthenticated()) : ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link disabled">
                            <?= $this->getUser()->login ?>
                        </a>
                    </li>
                <?php endif ?>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">Выход</a>
                </li>
            </ul>
        </div>
    </nav>
    <header><h1 class="title-main"><?= $this->title ?></h1></header>
    <div class="container">
        <?= $this->getBodyContent() ?>
    </div>
</body>
</html>
