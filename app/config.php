<?php
$host = '127.0.0.1';       // Utiliser 127.0.0.1 pour éviter les problèmes de socket
$dbname = 'ecoride';    // Nom de la base base de données ecoride créée dans PHPmyadmin
$username = 'admin_ecoride'; // Utilisateur créé dans PHPmyadmin avec droits complets à la base de données ecoride
$password = 'MotDePasseFort123!'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie ✅"; // décommente si tu veux tester immédiatement
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>