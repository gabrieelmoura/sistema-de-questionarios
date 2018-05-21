<?php

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$auth = \App\Model\Usuario::find($_SESSION['user_id']);