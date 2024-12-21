<?php
$error_message = "";

try {
    $bdd = new PDO('mysql:host=localhost;dbname=shassentexstille;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id']) && isset($_GET['table'])) {
        $id = $_GET['id'];
        $table = $_GET['table'];

        $query = $bdd->prepare("SELECT * FROM $table WHERE id = :id");
        $query->execute(array(':id' => $id));
        $produit = $query->fetch(PDO::FETCH_ASSOC);
        if (!$produit) {
            $error_message = "Produit non trouvé.";
        }
    } else {
        $error_message = "Identifiant de produit ou table manquant.";
    }
} catch (PDOException $e) {
    $error_message = "Erreur : " . $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['rate']) && isset($_FILES['img'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $rate = $_POST['rate'];
        $img = file_get_contents($_FILES['img']['tmp_name']);

        try {
            $query = $bdd->prepare("UPDATE $table SET nom = :nom, description = :description, prix = :prix, rate = :rate, img = :img WHERE id = :id");
            $query->bindParam(':nom', $nom);
            $query->bindParam(':description', $description);
            $query->bindParam(':prix', $prix);
            $query->bindParam(':rate', $rate);
            $query->bindParam(':img', $img, PDO::PARAM_LOB);
            $query->bindParam(':id', $id);
            $query->execute();

            header("Location: dashboard.php");
            exit();
        } catch (PDOException $e) {
            $error_message = "Erreur : " . $e->getMessage();
        }
    } else {
        $error_message = "Veuillez remplir tous les champs !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Modifier un Produit</h1>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        <?php if (isset($produit)): ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="table" value="<?= htmlspecialchars($table) ?>">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($produit['description']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" value="<?= htmlspecialchars($produit['prix']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Rate</label>
                <input type="text" class="form-control" id="rate" name="rate" value="<?= htmlspecialchars($produit['rate']) ?>" required>
            </div><div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control" id="img" name="img">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
        <?php endif; ?>
    </div>
</body>
</html>