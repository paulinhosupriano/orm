<?php

require 'db_config.php';
require '../vendor/autoload.php';

require 'Models/User.php';
require 'Models/UserDatabase.php';

use Example\Models\User;
use Example\Models\UserDatabase;

const DATABASE = [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "banco_de_dados",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

/*
 * MODEL
 */
echo "<h1>Normal User</h1>";
$user = (new User())->findById(5);
var_dump($user->data());

echo "<h1>Another DB User</h1>";

use PaulinhoSupriano\Orm\Connect;

/*
 * GET PDO instance AND errors
 */
$connect = Connect::getInstance(DATABASE);
$users = $connect->query("SELECT * FROM nome_da_tabela LIMIT 1");
var_dump($users->fetch(PDO::FETCH_OBJ));

$user = (new UserDatabase())->findById(1);
var_dump($user->data());

echo "<h1>Normal User Again</h1>";
$user = (new User())->findById(5);
var_dump($user->data());