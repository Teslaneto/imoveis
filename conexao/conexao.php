<?php
$host = "db";
$dbname = "crm_imobiliario";
$user = "root";
$pass = "root";
$port = "3306";

try {
    $conex = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
?>
