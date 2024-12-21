<?php
$error_message = "";

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shassentexstille;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifiez si l'ID et la table sont définis dans l'URL
    if (isset($_GET['id']) && isset($_GET['table'])) {
        $id = $_GET['id'];
        $table = $_GET['table'];

        // Supprimer le produit de la table spécifiée
        $query = $bdd->prepare("DELETE FROM $table WHERE id = :id");
        $query->execute(array(':id' => $id));

        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Identifiant de produit ou table manquant.";
    }
} catch (PDOException $e) {
    $error_message = "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Supprimer un Produit</h1>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
    </div>
</body>
</html>