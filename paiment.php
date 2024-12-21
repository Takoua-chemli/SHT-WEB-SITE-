<?php
session_start();
require 'config.php';

try {
    // Calculer le total du panier
    $total = 0;
    foreach ($_SESSION['panier'] as $article) {
        $total += $article['prix'] * $article['quantite'];
    }

    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $carte = $_POST['carte'];
    $expiration = $_POST['expiration'];
    $cvv = $_POST['cvv'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];

    // Vérifiez que toutes les données sont présentes
    if (empty($nom) || empty($carte) || empty($expiration) || empty($cvv) || empty($adresse) || empty($ville) || empty($code_postal) || empty($pays)) {
        throw new Exception('Veuillez remplir tous les champs.');
    }

    // Connexion à la base de données avec PDO depuis config.php
    $pdo = maConnexion();

    // Préparer la requête d'insertion
    $stmt = $pdo->prepare("INSERT INTO commandes (nom, carte, expiration, cvv, adresse, ville, code_postal, pays, total, date_commande) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
    
    // Exécuter la requête
    if ($stmt->execute([$nom, $carte, $expiration, $cvv, $adresse, $ville, $code_postal, $pays, $total])) {
        echo "Commande enregistrée avec succès.";
    } else {
        throw new Exception('Erreur lors de l\'enregistrement de la commande.');
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>