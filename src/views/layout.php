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
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="navbar-collapse collapse justify-content-between">
            <a class="navbar-brand" href="/">Телефонная книга</a>
            <ul class="navbar-nav ml-auto">
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
