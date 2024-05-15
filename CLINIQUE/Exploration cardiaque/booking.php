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

function checkAndReserveSlot($time, $date, $nom, $prenom, $telephone, $email) {
    global $conn;

    // Vérifier si l'heure est déjà réservée
    $sql = "SELECT * FROM reservationexploration_cardiaque WHERE date = '$date' AND time = '$time'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // L'heure est déjà réservée, retourner false
        return false;
    } else {
        // L'heure est disponible, effectuer la réservation
        $sql = "INSERT INTO reservationexploration_cardiaque (date, time, nom, prenom, telephone, email)
                VALUES ('$date', '$time', '$nom', '$prenom', '$telephone', '$email')";
        if ($conn->query($sql) === TRUE) {
            return true; // Réservation réussie
        } else {
            return false; // Erreur lors de la réservation
        }
    }
}

// Récupérer toutes les heures déjà réservées pour la date sélectionnée
$reserved_times = array();

if (isset($_POST["date"])) {
    $date = $_POST["date"];
    $sql = "SELECT time FROM reservationexploration_cardiaque WHERE date = '$date'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Fetch all reserved times and store them in the $reserved_times array
        while ($row = $result->fetch_assoc()) {
            // Extract only the hour and minute part of the time
            $time = date("H:i", strtotime($row["time"]));
            $reserved_times[] = $time;
        }
    }
}

// Vérifier si le formulaire est soumis
$reservation_status = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reserver"])) {
    $date = $_POST["date"];
    $time = $_POST["time"];
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
    $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";

    // Appeler la méthode checkAndReserveSlot avec les données du formulaire
    $reservation_status = checkAndReserveSlot($time, $date, $nom, $prenom, $telephone, $email);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles.css">
    </head>
 <body>
<nav class="sticky navbar">
	<div class="brand  display__logo">
		<a href="#top" class="nav__link"> <span class="logo"></span></a>
	</div>
            <label for="nav" class="nav__open"><i></i><i></i><i></i></label>
            <div class="nav">
                <ul class="nav__items">
                    <li class="has-dropdown">
        <a href="#" class="desktop-item">Prise de RDV</a>
              <label for="showDrop" class="mobile-item">Prise de RDV</label>
              <ul class="drop-menu">
                <li><a href="booking.php">RADIO</a></li>
                <li><a href="pma\booking.php">PMA</a></li>
                <li><a href="Maternité/booking.php">Maternité</a></li>
                <li><a href="Exploration cardiaque\booking.php">Exploration cardiaque</a></li>
                <li><a href="Endoscopie\booking.php">Endoscopie</a></li>
                <li><a href="Dialyse\booking.php">Dialyse</a></li>
                <li><a href="Consultation pré anesthésie\booking.php">Consultation pré anesthésie</a></li>
                <li><a href="Consultation médecine\booking.php">Consultation médecine</a></li>
              </ul>
            </li>
            <li>
            <li class="has-dropdown">
              <a href="#" class="desktop-item">LES SPÉCIALITÉS CHIRURGICALES</a>
              <label for="showDrop" class="mobile-item">LES SPÉCIALITÉS CHIRURGICALES</label>
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
            <li>
                <li class="has-dropdown">
              <a href="#" class="desktop-item">CENTRES D’EXPLORATIONS</a>
              <label for="showDrop" class="mobile-item">CENTRES D’EXPLORATIONS</label>
              <ul class="drop-menu">
              <li><a href="radio\booking.php">Exploration Radiologique</a></li>
              <li><a href="pma\booking.php">Exploration Digestive</a></li>
              <li><a href="Maternité/booking.php">Exploration Cardiaque</a></li>
              <li><a href="Exploration cardiaque\booking.php">Exploration Biologique</a></li>
              <li><a href="Endoscopie\booking.php">Dialyse</a></li>
  
            </ul>
            </li>
            <li>
                <li class="has-dropdown">
              <a href="#" class="desktop-item">PÔLES D'ACTIVITÉS</a>
                <label for="showDrop" class="mobile-item"> PÔLES D'ACTIVITÉS</label>
                <ul class="drop-menu">
                <li><a href="radio\booking.php">Pôle Mère et enfant</a></li>
                <li><a href="pma\booking.php">Pôle de chirurgie Viscérale</a></li>
                <li><a href="Maternité/booking.php">Pôle d’Oncologie</a></li>
                <li><a href="Exploration cardiaque\booking.php">Pôle Médico-chirurgical de l’Urologie</a></li>
                <li><a href="Endoscopie\booking.php">Pôle de l’orthopédie et de la colonne vertébrale</a></li>
                <li><a href="Dialyse\booking.php">Pôle de la médecine d’urgence et de la réanimation</a></li>
              </ul>
            </li>

            <li>
            <li class="has-dropdown">
              <a href="#" class="desktop-item">LES SPÉCIALITÉS MÉDICALES</a>
              <label for="showDrop" class="mobile-item">LES SPÉCIALITÉS MÉDICALES</label>
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
            
            <li><a href="#">Feedback</a></li>
          </ul>
          <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
        </div>
 
	</div>
</nav>
<main>
    <section class="container">
        <div class="container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="date">Date :</label>
                <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>">
                <select id="time" name="time" required>
                    <option value="" selected disabled>Choisir l'heure</option>
                    <?php
                    $start_time = strtotime("08:00");
                    $end_time = strtotime("19:00");
                    $interval = 30 * 60;
                    while ($start_time < $end_time) {
                        $time_str = date("H:i", $start_time);
                        if (in_array(substr($time_str, 0, 5), $reserved_times)) {
                            echo "<option value='$time_str' disabled class='unavailable'>$time_str</option>";
                        } else {
                            echo "<option value='$time_str'>$time_str</option>";
                        }
                        $start_time += $interval;
                    }
                    ?>
                </select><br><br>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required><br><br>
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required><br><br>
                <label for="telephone">Téléphone :</label>
                <input type="text" id="telephone" name="telephone" required><br><br>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required><br><br>
                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea><br><br>
                <label for="dob">Date de Naissance :</label>
                <input type="date" id="dob" name="dob" required><br><br>
                <label for="img">Image :</label>
                <input type="file" id="img" name="img" accept="image/*"><br><br>
                <input type="submit" name="reserver" value="Reserver">
            </form>
        </div>
    </section>
        </form>
    </div>
		</div>
	</section>
	<section class="about">
		<div id="about">
		
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
    <div class="footer-content">
        <nav class="footer-nav">
            <div><a href="#">About</a></div>
            <div><a href="#">Blog</a></div>
            <div><a href="#">Team</a></div>
            <div><a href="#">Pricing</a></div>
            <div><a href="#">Contact</a></div>
            <div><a href="#">Terms</a></div>
        </nav>
        <div class="social-icons">
            <a href="#" class="social-icon"><span class="sr-only">Facebook</span>
                <svg aria-hidden="true" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                </svg>
            </a>
            <!-- Add similar markup for other social media icons -->
        </div>
        <p class="copyright">© 2021 SomeCompany, Inc. All rights reserved.</p>
    </div>
</footer>
    <script>
  // Declare selectElement globally
let selectElement;

// Function to disable unavailable times
function disableUnavailableTimes() {
    let options = selectElement.options;
    for (let i = 0; i < options.length; i++) {
        let timeStr = options[i].value;
        if (reservedTimes.includes(timeStr.substr(0, 5)) || timeStr === "") {
            options[i].disabled = true;
            options[i].classList.add('unavailable');
        } else {
            options[i].disabled = false;
            options[i].classList.remove('unavailable');
        }
    }
}

// Function to refresh the disabled times when date changes
function refreshReservedTimes(date) {
    // Make an AJAX request to fetch reserved times for the selected date
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetradioch.php?date=" + date, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the reservedTimes array with the fetched data
            reservedTimes = JSON.parse(xhr.responseText);
            // Disable/unavailable times based on the updated reservedTimes
            disableUnavailableTimes();
        }
    };
    xhr.send();
}

// Array of reserved times (assuming it's defined somewhere in your PHP code)
let reservedTimes = <?php echo json_encode($reserved_times); ?>;

document.addEventListener('DOMContentLoaded', function() {
    // Initialize the select element
    selectElement = document.getElementById('time');
    
    // Call the function initially to disable times
    disableUnavailableTimes();
    
    // Add event listener to the date input to update times when date changes
    document.getElementById('date').addEventListener('change', function() {
        // Get the selected date
        let selectedDate = this.value;
        // Call the function to refresh reserved times for the selected date
        refreshReservedTimes(selectedDate);
        // Reset selected time when date changes
        selectElement.selectedIndex = 0;
    });

    // Add event listener to the time select to prevent selecting unavailable times
    selectElement.addEventListener('change', function() {
        let selectedTime = selectElement.value;
        if (reservedTimes.includes(selectedTime.substr(0, 5))) {
            // If the selected time is reserved, reset selection
            selectElement.selectedIndex = 0;
        }
    });
});
    </script>
</body>
</html>
