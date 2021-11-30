<?php

$sName = 'localhost';
$uName = 'root';
$pass = 'root';
$db_name = 'list';

try {
    $connexion = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    echo "Connection failed :". $e->getMessage();
}
