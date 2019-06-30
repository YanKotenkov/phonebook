<?php
/**
 * @var \lib\View $this
 * @var \forms\UserForm $user
 */
?>
<form action="/auth" method="post">
    <div class="card">
        <div class="card-body">
            <?php if (isset($errors)) : ?>
                <div class="errors border border-danger bg-danger py-2 px-3 rounded">
                    <?php foreach ($errors as $error) : ?>
                        <?php foreach ($error as $errorMessage) : ?>
                            <div><?= $errorMessage ?></div>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
            <div class="form-group">
                <label for="login"><?= $user->getLabel('login') ?></label>
                <input
                    class="form-control"
                    type="text"
                    name="login"
                    id="login"
                    placeholder="<?= $user->getLabel('login') ?>"
                    value="<?= $this->encode($user->login) ?>"
                    <?= $user->isRequired('login') ? 'required' : '' ?>
                >
            </div>
            <div class="form-group">
                <label for="password"><?= $user->getLabel('password') ?></label>
                <input
                    class="form-control"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="<?= $user->getLabel('password') ?>"
                    <?= $user->isRequired('password') ? 'required' : '' ?>
                >
            </div>
            <input type="submit" class="btn btn-success" value="Войти">
            <a href="/register" class="btn btn-primary">Регистрация</a>
        </div>
    </div>
</form>
