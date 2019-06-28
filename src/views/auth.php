<?php
/**
 * @var \lib\View $this
 * @var \models\User $user
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
                <label for="login">Логин</label>
                <input
                    class="form-control"
                    type="text"
                    name="login"
                    id="login"
                    placeholder="Логин"
                    value="<?= $user->login ?>"
                    required
                >
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Пароль" required>
            </div>
            <input type="submit" class="btn btn-success" value="Войти">
        </div>
    </div>
</form>
