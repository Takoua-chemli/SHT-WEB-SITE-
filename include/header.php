<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="css\Style1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!--Local-->
  <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>


<header class="header">
    <div class="container">
      <div class="row v-center">
        <div class="header-item item-left">
          <a href="index.php"><img src="Image/LogoSample_ByTailorBrands-remove (2).png" class="logo" alt="Logo" id="logo"></a>
        </div>
        <!-- menu start here -->
        <div class="header-item item-center">
          <div class="menu-overlay"></div>
          <nav class="menu">
            <ul class="menu-main">
              <li><a href="index.php">Accuil </a></li>

              <li class="menu-item-has-children">
                <a href="catalouge.html">Catalogue </a>
                <div class="sub-menu single-column-menu">
                  <ul>
                    <li><a href="tissucoton.php">Conton</a></li>
                    <li><a href="tissusatin.php">Satin </a></li>
                    <li><a href="tissujerzy.php">Jerzy</a></li>
                  </ul>
                </div>
              </li>
              <li class="menu-item-has-children">
                <a href="contact.php">Contact  </a>
              </li>
              <li class="menu-item-has-children">
                <a href="about.php"> About </a>
              </li>
              
              <li class="menu-item-has-children">
                <a href=""> <i class='bx bx-user'></i></a>
                <div class="sub-menu single-column-menu">
                  <ul>
                    <li><a href="Inscription.php">S'inscrire</a></li>
                    <li><a href="connexion.php">Se connecter</a></li>
                  </ul>
                </div>
              </li>

            </ul>
          </nav>
         
      </div>
    </div>
    <div class="header-item item-right">
          <a href=""></a>
          <a href="recherche.php"><i class='bx bx-search-alt-2'></i></a>
          <a href="panier.php"><i class='bx bx-cart'></i></a>
          <a href="logout.php"><i class='bx bx-log-out'></i></a>
          
        </div>
  </header>
</body>
</html>