<?php
session_start();
require __DIR__ . '/config.php'; 

// Vérifier que le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['Email'] ?? '');
    $password = $_POST['Password'] ?? '';

    if (empty($email) || empty($password)) {
        die("Veuillez remplir tous les champs.");
    }

    // Préparer la requête sécurisée
    $stmt = $pdo->prepare("SELECT id, pseudo, password FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Connexion réussie → stocker les infos dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['pseudo'] = $user['pseudo'];

        // Redirection vers la page profil ou tableau de bord
        header("Location: profil.php");
        exit();
    } else {
        // Identifiant ou mot de passe incorrect
        $_SESSION['login_error'] = "Email ou mot de passe incorrect.";
        header("Location: connexion.php");
        exit();
    }
} else {
    // Accès direct au script → rediriger
    header("Location: connexion.php");
    exit();
}
