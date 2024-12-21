<?php
session_start(); 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['prix']) && isset($_POST['rate']) && isset($_FILES['img']) && isset($_POST['table'])) {
        $nom = $_POST['nom'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $rate = $_POST['rate'];
        $img = file_get_contents($_FILES['img']['tmp_name']);
        $table = $_POST['table'];

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=shassentexstille;charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            $tables_valides = ['tissusatin', 'tissucoton', 'jerzy'];
            if (!in_array($table, $tables_valides)) {
                throw new Exception("Table invalide.");
            }

            $query = $bdd->prepare("INSERT INTO $table (nom, description, prix, rate, img) VALUES (:nom, :description, :prix, :rate, :img)");
            $query->bindParam(':nom', $nom);
            $query->bindParam(':description', $description);
            $query->bindParam(':prix', $prix);
            $query->bindParam(':rate', $rate);
            $query->bindParam(':img', $img, PDO::PARAM_LOB);
            $query->execute();

            $success_message = "Produit ajouté avec succès !";
        } catch (PDOException $e) {
            $error_message = "Erreur de base de données : " . $e->getMessage();
        } catch (Exception $e) {
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
    <title>Ajouter un Produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Produit</h1>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
        <?php endif; ?>
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
        <?php endif; ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" required>
            </div>
            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="text" class="form-control" id="prix" name="prix" required>
            </div>
            <div class="mb-3">
                <label for="rate" class="form-label">Rate</label>
                <input type="text" class="form-control" id="rate" name="rate" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control" id="img" name="img" required>
            </div>
            <div class="mb-3">
                <label for="table" class="form-label">Table</label>
                <select class="form-control" id="table" name="table" required>
                    <option value="tissusatin">Tissu Satin</option>
                    <option value="tissucoton">Tissu Coton</option>
                    <option value="<option value="jerzy">Jerzy</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>