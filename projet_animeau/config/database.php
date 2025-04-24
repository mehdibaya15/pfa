<?php
if (!defined('ADMIN_EMAIL')) {
    define('ADMIN_EMAIL', 'pettyadmin@gmail.com');
}

if (!defined('ADMIN_PASS')) {
    define('ADMIN_PASS', 'petty1234');
}
$db_server = "127.0.0.1";
$db_username = "root";
$db_pwd = "";
$db_name = "pettybd";
$charset = 'utf8mb4';
$dsn = "mysql:host=$db_server;dbname=$db_name;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $cnx = new PDO($dsn, $db_username, $db_pwd, $options);
} catch (\PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

 
