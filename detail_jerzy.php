<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $pdo = maConnexion();
    $sql = "SELECT * FROM jerzy WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produit) {
        header('Location: tissujerzy.php');
        exit();
    }
} else {
    header('Location: tissujerzy.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/mega-nav.css">
    <link rel="stylesheet" href="css/cataluge.css">
    <title>Détail du produit</title>
</head>
<body>
    <!-- Inclure le header -->
    <?php include 'include/header.php'; ?>

    <section id="product-detail" class="section p1">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php if (!empty($produit['img'])) { ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($produit['img']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>" class="img-fluid">
                    <?php } ?>
                </div>
                <div class="col-md-6">
                    <h1><?php echo htmlspecialchars($produit['nom']); ?></h1>
                    <div class="star">
                        <?php for ($i = 0; $i < $produit['rate']; $i++) { ?>
                            <i class='bx bxs-star'></i>
                        <?php } ?>
                    </div>
                    <h4><?php echo htmlspecialchars($produit['prix']); ?> DT/ m</h4>
                    <p><?php echo htmlspecialchars($produit['description']); ?></p>
                    <a href="panier.php?action=add&id=<?php echo $produit['id']; ?>" class="btn btn-success">Ajouter au panier</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Inclure le footer -->
    <?php include 'include/footer.php'; ?>

    <!-- Liens vers les scripts JavaScript -->
</body>
</html>
