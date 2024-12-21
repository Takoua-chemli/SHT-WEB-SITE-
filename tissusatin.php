<?php
include('config.php');

$pdo = maConnexion();
$sql = "SELECT * FROM tissusatin";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tissusatinData = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&family=Roboto:ital,wght@0,400;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <title>Catalogue de produits</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/mega-nav.css">
    <link rel="stylesheet" href="css/cataluge.css">
</head>
<body>
    <!-- Inclure le header -->
    <?php include 'include/header.php'; ?>

    <section id="product1" class="section p1">
        <div class="pro-container">
            <?php foreach ($tissusatinData as $tissu) { ?>
                <div class="pro">
                    <?php if (!empty($tissu['img'])) { ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($tissu['img']); ?>" alt="">
                    <?php } ?>
                    <div class="des">
                        <span><?php echo htmlspecialchars($tissu['nom']); ?></span>
                        <div class="star">
                            <?php for ($i = 0; $i < $tissu['rate']; $i++) { ?>
                                <i class='bx bxs-star'></i>
                            <?php } ?>
                        </div>
                        <h4><?php echo htmlspecialchars($tissu['prix']); ?> DT/ m</h4>
                    </div>
                    <a href="deatilsatin.php?id=<?php echo $tissu['id']; ?>" class="btn btn-primary">Voir Détails</a>
                    <a href="panier.php?action=add&id=<?php echo $tissu['id']; ?>" class="btn btn-success"><i class='bx bx-cart-add cart'></i></a>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Inclure le footer -->
    <?php include 'include/footer.php'; ?>

    <!-- Liens vers les scripts JavaScript -->
</body>
</html>
