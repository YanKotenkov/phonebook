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
    <nav class="nav-main">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="/" class="navbar-brand">Телефонная книга</a>
            </div>
        </div>
    </nav>
    <header><h1 class="title-main"><?= $this->title ?></h1></header>
    <div class="container">
        <?= $this->getBodyContent() ?>
    </div>
</body>
</html>
