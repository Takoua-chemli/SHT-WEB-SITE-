<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Démarrer la session

// Initialiser le panier s'il n'existe pas
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Fonction pour ajouter un article au panier
function ajouterAuPanier($id, $nom, $prix, $quantite) {
    // Si l'article existe déjà dans le panier, on met à jour la quantité
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite'] += $quantite;
    } else {
        // Sinon, on ajoute l'article au panier
        $_SESSION['panier'][$id] = array(
            'nom' => $nom,
            'prix' => $prix,
            'quantite' => $quantite
        );
    }
}

// Fonction pour mettre à jour la quantité d'un article
function mettreAJourQuantite($id, $quantite) {
    if (isset($_SESSION['panier'][$id])) {
        $_SESSION['panier'][$id]['quantite'] = $quantite;
        // Si la quantité est zéro, on supprime l'article du panier
        if ($_SESSION['panier'][$id]['quantite'] <= 0) {
            unset($_SESSION['panier'][$id]);
        }
    }
}

// Fonction pour supprimer un article du panier
function supprimerDuPanier($id) {
    if (isset($_SESSION['panier'][$id])) {
        unset($_SESSION['panier'][$id]);
    }
}

// Connexion à la base de données
include('config.php');

// Vérifiez si la fonction maConnexion existe
if (function_exists('maConnexion')) {
    $pdo = maConnexion();
} else {
    die('La fonction maConnexion n\'existe pas.');
}

// Traiter les actions (ajout, mise à jour, suppression)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['action']) && isset($_GET['id'])) {
        $action = $_GET['action'];
        $id = $_GET['id'];

        // Récupérer les informations du produit depuis la base de données
        $stmt = $pdo->prepare("SELECT * FROM tissusatin WHERE id = ?");
        $stmt->execute([$id]);
        $tissu = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tissu) {
            $nom = $tissu['nom'];
            $prix = $tissu['prix'];
            $quantite = 1;

            switch ($action) {
                case 'add':
                    ajouterAuPanier($id, $nom, $prix, $quantite);
                    echo "Article ajouté au panier.";
                    break;
                case 'update':
                    $quantite = isset($_GET['quantite']) ? (int)$_GET['quantite'] : 1;
                    mettreAJourQuantite($id, $quantite);
                    echo "Quantité mise à jour.";
                    break;
                case 'remove':
                    supprimerDuPanier($id);
                    echo "Article supprimé du panier.";
                    break;
                default:
                    echo "Action non reconnue.";
                    break;
            }
        } else {
            echo "Article non trouvé.";
        }
    } else {
        echo "Paramètres manquants.";
    }
} else {
    echo "Requête invalide.";
}

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
    <title>Panier</title>
    <!-- Inclure Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
    // Inclure le header et vérifier s'il existe
if (file_exists('include/header.php')) {
    include 'include/header.php';
} else {
    echo 'Le fichier header.php est introuvable.';
}
?>
<div class="container mt-5">
    <h2>Mon Panier</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['panier'])): ?>
                <?php foreach ($_SESSION['panier'] as $id => $article): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($article['nom']); ?></td>
                        <td><?php echo number_format($article['prix'], 2, ',', ' '); ?> DT</td>
                        <td>
                            <form action="panier.php" method="get" class="d-inline">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="number" name="quantite" value="<?php echo $article['quantite']; ?>" min="0" class="form-control d-inline-block" style="width: 60px;">
                                <button type="submit" class="btn btn-primary btn-sm">Mettre à jour</button>
                            </form>
                        </td>
                        <td><?php echo number_format($article['prix'] * $article['quantite'], 2, ',', ' '); ?> DT</td>
                        <td>
                            <a href="panier.php?action=remove&id=<?php echo $id; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Votre panier est vide.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <div class="text-end">
        <h3>Total : <?php echo number_format($total, 2, ',', ' '); ?> DT</h3>
        <a href="checkout.php" class="btn btn-success">Passer à la caisse</a>
    </div>
</div>
<?php
// Inclure le footer et vérifier s'il existe
if (file_exists('include/footer.php')) {
    include 'include/footer.php';
} else {
    echo 'Le fichier footer.php est introuvable.';
}
?>
<!-- Inclure Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>