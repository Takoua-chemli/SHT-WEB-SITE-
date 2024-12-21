<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=shassentexstille;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupérer les produits des différentes tables
$tissusatin = $bdd->query('SELECT *, "tissusatin" AS table_name FROM tissusatin')->fetchAll(PDO::FETCH_ASSOC);
$tissucoton = $bdd->query('SELECT *, "tissucoton" AS table_name FROM tissucoton')->fetchAll(PDO::FETCH_ASSOC);
$jerzy = $bdd->query('SELECT *, "jerzy" AS table_name FROM jerzy')->fetchAll(PDO::FETCH_ASSOC);

// Fusionner tous les produits
$produits = array_merge($tissusatin, $tissucoton, $jerzy);

// Récupérer les utilisateurs
$utilisateurs = $bdd->query('SELECT * FROM user')->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Tableau de Bord Admin</h1>
        
        <!-- Section Produits -->
        <h2>Produits</h2>
        <a href="ajouter_produit.php" class="btn btn-success">Ajouter un Produit</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Rate</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produits as $produit): ?>
                    <tr>
                        <td><?= $produit['id'] ?></td>
                        <td><?= htmlspecialchars($produit['nom']) ?></td>
                        <td><?= htmlspecialchars($produit['description']) ?></td>
                        <td><?= htmlspecialchars($produit['prix']) ?></td>
                        <td><?= htmlspecialchars($produit['rate']) ?></td>
                        <td><img src="data:image/jpeg;base64,<?= base64_encode($produit['img']) ?>" width="50"></td>
                        <td><?= htmlspecialchars($produit['table_name']) ?></td>
                        <td>
                            <a href="modifier_produit.php?id=<?= $produit['id'] ?>&table=<?= $produit['table_name'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="supprimer_produit.php?id=<?= $produit['id'] ?>&table=<?= $produit['table_name'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <!-- Section Utilisateurs -->
        <h2>Utilisateurs</h2>
        <a href="ajouter_utilisateur.php" class="btn btn-success">Ajouter un Utilisateur</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?= $utilisateur['id'] ?></td>
                        <td><?= htmlspecialchars($utilisateur['nom']) ?></td>
                        <td><?= htmlspecialchars($utilisateur['email']) ?></td>
                        <td><?= htmlspecialchars($utilisateur['role']) ?></td>
                        <td>
                            <a href="modifier_utilisateur.php?id=<?= $utilisateur['id'] ?>" class="btn btn-warning">Modifier</a>
                            <a href="supprimer_utilisateur.php?id=<?= $utilisateur['id'] ?>" class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>