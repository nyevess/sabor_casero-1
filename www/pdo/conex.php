<?php 
define('DB_HOST','mysql');
define('DB_USER','root');
define('DB_PASS','12345');
define('DB_NAME','sabor_casero');

try
{
    $base = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
    exit("Error: " . $e->getMessage());
}
?>