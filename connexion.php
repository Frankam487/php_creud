<?php

$host = 'localhost';
$dbname = 'student';
$username = 'root'; 
$password = '';


try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
$stmt = $pdo->prepare("SELECT * FROM eleve");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// print_r($result);
?>