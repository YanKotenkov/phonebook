<?php
/**
 * @var \lib\View $this
 * @var \models\User $user
 */
?>
<form action="/auth" method="post">
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label for="login">Логин</label>
                <input
                    class="form-control"
                    type="text"
                    name="login"
                    id="login"
                    placeholder="Логин"
                    value="<?= $user->login ?>"
                >
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Пароль">
            </div>
            <input type="submit" class="btn btn-success" value="Войти">
        </div>
    </div>
</form>
