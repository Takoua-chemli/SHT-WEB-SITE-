<?php
session_start();

// Calculer le total du panier
$total = 0;
foreach ($_SESSION['panier'] as $article) {
    $total += $article['prix'] * $article['quantite'];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passer à la caisse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    if (file_exists('include/header.php')) {
        include 'include/header.php';
    } else {
        echo 'Le fichier header.php est introuvable.';
    }
    ?>
    <div class="container mt-5">
        <h2>Passer à la caisse</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['panier'] as $id => $article): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($article['nom']); ?></td>
                        <td><?php echo number_format($article['prix'], 2, ',', ' '); ?> DT</td>
                        <td><?php echo $article['quantite']; ?></td>
                        <td><?php echo number_format($article['prix'] * $article['quantite'], 2, ',', ' '); ?> DT</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="text-end">
            <h3>Total : <?php echo number_format($total, 2, ',', ' '); ?> DT</h3>
        </div>
        <form action="paiment.php" method="post">
            <h4>Informations de paiement</h4>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="carte" class="form-label">Numéro de carte</label>
                <input type="text" class="form-control" id="carte" name="carte" required>
            </div>
            <div class="mb-3">
                <label for="expiration" class="form-label">Date d'expiration</label>
                <input type="text" class="form-control" id="expiration" name="expiration" required>
            </div>
            <div class="mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" required>
            </div>
            <h4>Adresse de livraison</h4>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
            <div class="mb-3">
                <label for="ville" class="form-label">Ville</label>
                <input type="text" class="form-control" id="ville" name="ville" required>
            </div>
            <div class="mb-3">
                <label for="code_postal" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="code_postal" name="code_postal" required>
            </div>
            <div class="mb-3">
                <label for="pays" class="form-label">Pays</label>
                <input type="text" class="form-control" id="pays" name="pays" required>
            </div>
            <button type="submit" class="btn btn-success">Payer</button>
        </form>
    </div>
    <?php
    if  (file_exists('include/footer.php')) {
        include 'include/footer.php';
    } else {
        echo 'Le fichier footer.php est introuvable.';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>