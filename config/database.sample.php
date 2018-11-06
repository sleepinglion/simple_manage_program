<?php
    $config['db']='your dbname';
    $config['user']='your db user';
    $config['password']='your db password';
    $config['timezone']=New DateTimeZone('Asia/Seoul');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);    

    $pdo = new PDO('mysql:host=localhost;dbname='.$config['db'],$config['user'], $config['password']);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    