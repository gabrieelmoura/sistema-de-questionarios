<?php

require_once __DIR__ . '/includes/init.php';

$user = App\Model\Usuario::firstOrCreate([
    'email' => $_POST['email']
]);

$_SESSION['user_id'] = $user->id;
header('Location: questionarios.php');