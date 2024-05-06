<?php
    $config['db']='simple_manage';
    $config['user']='simple_manage';
    $config['password']='simple_manage1!' ;
    $config['timezone']=New DateTimeZone('Asia/Seoul');

    error_reporting(E_ALL);
    ini_set('display_errors', 1);    

    $pdo = new PDO('mysql:host=localhost;dbname='.$config['db'],$config['user'], $config['password']);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    