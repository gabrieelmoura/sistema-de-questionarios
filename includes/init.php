<?php 

require_once __DIR__ . "/../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$dbops = parse_url(getenv('CLEARDB_DATABASE_URL'));

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $dbops['host'],
    'database'  => ltrim($dbops['path'],'/'),
    'username'  => $dbops['user'],
    'password'  => $dbops['pass'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

session_start();