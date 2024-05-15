<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reservationDB";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles/styles.css">
  <link rel="stylesheet" type="text/css" href="styles/form.css">
  <link rel="stylesheet" href="styles/nav.css">
  <link rel="stylesheet" href="styles/footer.css">
</head>
<body>        	

<nav class="sticky navbar">
  <div class="brand display__logo">
    <a href="#top" class="nav__link"><span class="logo"></span></a>
  </div>
  <label for="nav" class="nav__open"><i></i><i></i><i></i></label>
  <input type="checkbox" id="nav" class="hidden">
  <div class="nav">
    <ul class="nav__items">
      <li class="has-dropdown">
        <a href="#" class="desktop-item">PRISE DE RDV</a>
        <a class="mobile-item" href="#" >PRISE DE RDV</>
        <input type="checkbox" id="showDrop" class="hidden">
        <ul class="drop-menu">
          <li><a href="radio\booking.php">RADIO</a></li>
          <li><a href="pma\booking.php">PMA</a></li>
          <li><a href="Maternité/booking.php">Maternité</a></li>
          <li><a href="Exploration cardiaque\booking.php">Exploration cardiaque</a></li>
          <li><a href="Endoscopie\booking.php">Endoscopie</a></li>
          <li><a href="Dialyse\booking.php">Dialyse</a></li>
          <li><a href="Consultation pré anesthésie\booking.php">Consultation pré anesthésie</a></li>
          <li><a href="Consultation médecine\booking.php">Consultation médecine</a></li>
        </ul>
      </li>
      <li class="has-dropdown">
        <a href="#" class="desktop-item">LES SPÉCIALITÉS CHIRURGICALES</a>
        <a class="mobile-item" href="#" >LES SPÉCIALITÉS CHIRURGICALES</a>
        <input type="checkbox" id="showDrop1" class="hidden">
        <ul class="drop-menu">
          <li><a href="radio\booking.php">Chirurgie Orthopédique et prothétique</a></li>
          <li><a href="pma\booking.php">Chirurgie viscérale & Digestive</a></li>
          <li><a href="Maternité/booking.php">Chirurgie du sein et de la femme</a></li>
          <li><a href="Exploration cardiaque\booking.php">Chirurgie Urologique et rénale</a></li>
          <li><a href="Endoscopie\booking.php">Chirurgie carcinologique</a></li>
          <li><a href="Dialyse\booking.php">Chirurgie plastique et esthétique</a></li>
          <li><a href="Consultation pré anesthésie\booking.php">Chirurgie Pédiatrique</a></li>
          <li><a href="Consultation médecine\booking.php">Chirurgie de la colonne vertébrale</a></li>
        </ul>
      </li>
      <li class="has-dropdown">
        <a href="#" class="desktop-item">CENTRES D’EXPLORATIONS</a>
        <a class="mobile-item" href="#" >CENTRES D’EXPLORATIONS</a>
        <input type="checkbox" id="showDrop2" class="hidden">
        <ul class="drop-menu">
          <li><a href="radio\booking.php">Exploration Radiologique</a></li>
          <li><a href="pma\booking.php">Exploration Digestive</a></li>
          <li><a href="Maternité/booking.php">Exploration Cardiaque</a></li>
          <li><a href="Exploration cardiaque\booking.php">Exploration Biologique</a></li>
          <li><a href="Endoscopie\booking.php">Dialyse</a></li>
        </ul>
      </li>
      <li class="has-dropdown">
        <a href="#" class="desktop-item">PÔLES D'ACTIVITÉS</a>
        <a class="mobile-item" href="#" > PÔLES D'ACTIVITÉS</a>
        <input type="checkbox" id="showDrop3" class="hidden">
        <ul class="drop-menu">
          <li><a href="radio\booking.php">Pôle Mère et enfant</a></li>
          <li><a href="pma\booking.php">Pôle de chirurgie Viscérale</a></li>
          <li><a href="Maternité/booking.php">Pôle d’Oncologie</a></li>
          <li><a href="Exploration cardiaque\booking.php">Pôle Médico-chirurgical de l’Urologie</a></li>
          <li><a href="Endoscopie\booking.php">Pôle de l’orthopédie et de la colonne vertébrale</a></li>
          <li><a href="Dialyse\booking.php">Pôle de la médecine d’urgence et de la réanimation</a></li>
        </ul>
      </li>
      
      <li class="has-dropdown">
        <a href="#" class="desktop-item">LES SPÉCIALITÉS MÉDICALES</a>
        <a class="mobile-item" href="#" >LES SPÉCIALITÉS MÉDICALES</a>
        <input type="checkbox" id="showDrop4" class="hidden">
        <ul class="drop-menu">
          <li><a href="radio\booking.php">Gastroentérologie & Hépatologie</a></li>
          <li><a href="pma\booking.php">Cardiologie</a></li>
          <li><a href="Maternité/booking.php">Endocrinologie et diabétologie</a></li>
          <li><a href="Exploration cardiaque\booking.php">Neurologie</a></li>
          <li><a href="Endoscopie\booking.php">Pneumologie</a></li>
          <li><a href="Dialyse\booking.php">Oncologie</a></li>
          <li><a href="Consultation pré anesthésie\booking.php">Néphrologie et Dialyse</a></li>
          <li><a href="Consultation médecine\booking.php">Hématologie</a></li>
          <li><a href="Consultation médecine\booking.php">Pédiatrie</a></li>
          <li><a href="Consultation médecine\booking.php">Gynécologue & Obstetrique</a></li>
      
        </ul>
      </li>

      <li class="has-dropdown">
        <a href="#" class="desktop-item">FEEDBACK</a>
        <a class="mobile-item" href="otherpages/feedback.php">FEEDBACK</a>
        <input type="checkbox" id="showDrop5" class="hidden">
       
      </li>
    </ul>
  </div>
</nav>
<main>
	<section class="home">
		<div id="home">
			<h1>Home</h1>
		</div>
	</section>
	<section class="about">
		<div id="about">
			<h1>About</h1>
		</div>
	</section>
	<section class="portfolio">
		<div id="portfolio">
			<h1>Portfolio</h1>
		</div>
	</section>
	<section class="contact">
		<div id="contact">
			<h1>Contact</h1>
		</div>
	</section>
</main>

  <footer class="footer">
    <div class="waves">
      <div class="wave" id="wave1"></div>
      <div class="wave" id="wave2"></div>
      <div class="wave" id="wave3"></div>
      <div class="wave" id="wave4"></div>
    </div>
    <ul class="social-icon">
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-facebook"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-twitter"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-linkedin"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-instagram"></ion-icon>
        </a></li>
    </ul>
    <ul class="menu">
      <li class="menu__item"><a class="menu__link" href="#">Home</a></li>
      <li class="menu__item"><a class="menu__link" href="#">About</a></li>
      <li class="menu__item"><a class="menu__link" href="#">Services</a></li>
      <li class="menu__item"><a class="menu__link" href="#">Team</a></li>
      <li class="menu__item"><a class="menu__link" href="#">Contact</a></li>

    </ul>
    <p>&copy;2024 | All Rights Reserved</p>
  </footer>
  </body>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
  const menuButton = document.getElementById('nav');
const wavesElement = document.querySelector('.waves');

menuButton.addEventListener('click', function() {
  // Toggle the class on the body
  document.body.classList.toggle('hide-waves');
});

const navOpen = document.querySelector('.nav__open');

menuButton.addEventListener('click', function() {
  // Toggle the 'fixed' class on nav__open
  navOpen.classList.toggle('fixed');
});


</script>

  </html>
