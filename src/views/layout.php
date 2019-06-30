<?php
/**
 * @var \lib\View $this
 */
?>
<html lang="ru-RU">
<head>
    <title><?= $this->title ?></title>
    <?php $this->registerCssFile('main') ?>
    <?php $this->registerCssFile('bootstrap.min') ?>
    <?php $this->registerJsFile('jquery.min') ?>
    <?php $this->registerJsFile('popper.min') ?>
    <?php $this->registerJsFile('bootstrap.min') ?>
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
