<?php
// Initialiser une variable pour les messages d'erreur
$error_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['email']) && isset($_POST['passe'])) {
        
        $email = $_POST['email'];
        $password = $_POST['passe'];
        
       
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=shassentexstille;charset=utf8', 'root', '');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (password_verify($password, $user['passe'])) {

              $_SESSION['user_id'] = $user['id'];
              $_SESSION['user_name'] = $user['nom']; 
            }
            
            $query = $bdd->prepare("SELECT * FROM user WHERE email = :email AND passe = :password");
            $query->execute(array(':email' => $email, ':password' => $password));
            
            if ($query->rowCount() > 0) {

                $user = $query->fetch(PDO::FETCH_ASSOC);
                
          
                if ($user['role'] === 'user') {
                    header("Location: index.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit(); 
            } else {
                $error_message = "Identifiants incorrects !"; 
            }
        } catch(PDOException $e) {
            $error_message = "Erreur : " . $e->getMessage();
        }
    } else {
        $error_message = "Veuillez remplir tous les champs !"; 
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title></title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <!--Links-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!--Local-->
  <link href="vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet">
  <link rel="stylesheet" href="css\Style1.css">
</head>
<body>
<?php include 'include/header.php'; ?>
  <!--START - MAIN-->
  <main id="main">
    <!--START -SECTION - CONTACT-->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row mt-5">
		  <section id="contact" class="contact">
			<div class="container">
			  <div class="row mt-5">
				<div class="col-lg-4" data-aos="fade-right">
				  <div class="info">
					  <div class="email">
						  <i class="bi bi-envelope"></i>
						  <h4>Email:</h4>
						  <p>Takouachemli@gmail.com</p>
						</div><br>
					<div class="address">
					  <i class="bi bi-geo-alt"></i>
					  <h4>Localisation:</h4>
					  <p>Rue Farhat Hachad Kasr Hellel Monastir ,5070</p>
					</div>
					<div class="phone">
					  <i class="bi bi-phone"></i>
					  <h4>Telephone:</h4>
					  <p>+21656497166</p>
					</div>
				  </div>
				</div>
				<div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left">
				  <div class="Cree un Compte">
					  <h4>Cree un Compte:</h4>
					</div><br>
				  <form action="" method="post" role="form" class="php-email-form">
					<div class="row">
					  <div class="col-md-6 form-group mt-3 mt-md-0">
						<input 
                          for="email"
						  type="email" 
						  class="form-control" 
						  name="email" 
						  id="email" 
						  placeholder="Entrez votre Email" 
						  required
						>
					  </div>
					  <div class="col-md-6 form-group mt-3 mt-md-0">
						  <input 
                            for="passe"
							type="password" 
							class="form-control" 
							name="passe" 
							id="passe" 
							placeholder="Entrez votre Mot de passe" 
							required
						  >
						</div>
					</div>
					<!-- Afficher le message d'erreur si présent -->
					<?php if (!empty($error_message)) : ?>
					<div class="my-3">
						<div class="error-message" style="color: red;"><?php echo $error_message; ?></div>
					</div>
					<?php endif; ?>
              <div class="my-3">
                <div class="loading">Chargement...</div>
                <div class="error-message"></div>
                <div class="sent-message">La connexion effectuer</div>
              </div>
              <div class="text-center"><button type="submit">Envoyer</button></div>
            </form>
          </div>
        </div>
      </div>
    </section><!--END -SECTION - CONTACT-->
  </main>  <!--END - MAIN-->
  <?php include 'include/footer.php'; ?>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>
  <!-- Vendor JS Files -->
  <!--Link-->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
  <!--Local-->
  <script src="vendor/swiper/swiper-bundle.min.js"></script>
  <script src="vendor/glightbox/js/glightbox.min.js"></script>
  <script src="vendor/purecounter/purecounter.js"></script>  
  <script src="vendor/waypoints/noframework.waypoints.js"></script>
  <!-- Template Main JS File -->
  <script src="js/main.js"></script>
  <script src="js/java.js"></script>
</body>
</html>
