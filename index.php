<?php require_once __DIR__ . '/includes/init.php'; ?>
<?php require_once __DIR__ . '/layout/top.php'; ?>
<div class="container text-center">
    <h1>Entrar</h1>
    <form method="POST" action="login.php">
        <div class="form-group text-left">
            <label>
                E-mail
            </label>
            <input type="text" name="email" class="form-control">
        </div>
        <button class="btn btn-primary">Entrar</button>
    </form>
</div>
<?php require_once __DIR__ . '/layout/bottom.php'; ?>