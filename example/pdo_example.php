<?php

require 'db_config.php';
require '../vendor/autoload.php';

use PaulinhoSupriano\Orm\Connect;

/*
 * GET PDO instance AND errors
 */
$connect = Connect::getInstance();
$error = Connect::getError();

/*
 * CHECK connection/errors
 */
if ($error) {
    echo $error->getMessage();
    exit;
}

/*
 * FETCH DATA
 */
$users = $connect->query("SELECT * FROM nome_da_tabela LIMIT 5");
var_dump($users->fetchAll());