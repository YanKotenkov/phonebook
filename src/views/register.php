<?php
/**
 * @var \forms\RegisterForm $registerForm
 */
 ?>
<form action="/register" method="post">
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
                <label for="login"><?= $registerForm->getLabel('login') ?></label>
                <input
                    class="form-control"
                    type="text"
                    name="login"
                    id="login"
                    placeholder="<?= $registerForm->getLabel('login') ?>"
                    value="<?= $this->encode($registerForm->login) ?>"
                    <?= $registerForm->isRequired('login') ? 'required' : '' ?>
                >
            </div>
            <div class="form-group">
                <label for="password"><?= $registerForm->getLabel('password') ?></label>
                <input
                    class="form-control"
                    type="password"
                    name="password"
                    id="password"
                    placeholder="<?= $registerForm->getLabel('password') ?>"
                    <?= $registerForm->isRequired('password') ? 'required' : '' ?>
                >
            </div>
            <div class="form-group">
                <label for="email"><?= $registerForm->getLabel('email') ?></label>
                <input
                    class="form-control"
                    type="text"
                    name="email"
                    id="email"
                    placeholder="<?= $registerForm->getLabel('email') ?>"
                    value="<?= $this->encode($registerForm->email) ?>"
                    <?= $registerForm->isRequired('email') ? 'required' : '' ?>
                >
            </div>
            <input type="submit" class="btn btn-success" value="Зарегистрироваться">
            <a href="/auth" class="btn btn-primary">Вход по логину и паролю</a>
        </div>
    </div>
</form>
