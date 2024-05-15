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
    $sql = "SELECT * FROM reservationdialyse WHERE date = '$date' AND time = '$time'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // L'heure est déjà réservée, retourner false
        return false;
    } else {
        // L'heure est disponible, effectuer la réservation
        $sql = "INSERT INTO reservationdialyse (date, time, nom, prenom, telephone, email)
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
    $sql = "SELECT time FROM reservationdialyse WHERE date = '$date'";
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
    <link rel="stylesheet" href="../radio/stylesRDV.css">
    <style>
        /* Enhanced contrast for better visibility of disabled options */
        .unavailable {
            background-color: #C0C0C0; /* Grey background */
            color: #333;
            cursor: not-allowed; /* Change cursor to not-allowed */
        }
    </style>
</head>
<body>
<body>
        <div>
           
            <nav>
  <div class="wrapper">
    <div class="logo"><a href="#">Logo</a></div>
    <input type="radio" name="slider" id="menu-btn">
    <input type="radio" name="slider" id="close-btn">
    <ul class="nav-links">
      <label for="close-btn" class="btn close-btn"><i class="fas fa-times"></i></label>
      <li><a href="../acceuil.php">Home</a></li>
      <li><a href="#">About</a></li>
      <li>
        <a href="#" class="desktop-item">Dropdown Menu</a>
        <input type="checkbox" id="showDrop">
        <label for="showDrop" class="mobile-item">Dropdown Menu</label>
        <ul class="drop-menu">
          <li><a href="#">Drop menu 1</a></li>
          <li><a href="#">Drop menu 2</a></li>
          <li><a href="#">Drop menu 3</a></li>
          <li><a href="#">Drop menu 4</a></li>
        </ul>
      </li>
      <li>
        <a href="#" class="desktop-item">Mega Menu</a>
        <input type="checkbox" id="showMega">
        <label for="showMega" class="mobile-item">Mega Menu</label>
        <div class="mega-box">
          <div class="content">
            <div class="row">
              <img src="https://fadzrinmadu.github.io/hosted-assets/responsive-mega-menu-and-dropdown-menu-using-only-html-and-css/img.jpg" alt="">
            </div>
            <div class="row">
              <header>Design Services</header>
              <ul class="mega-links">
                <li><a href="#">Graphics</a></li>
                <li><a href="#">Vectors</a></li>
                <li><a href="#">Business cards</a></li>
                <li><a href="#">Custom logo</a></li>
              </ul>
            </div>
            <div class="row">
              <header>Email Services</header>
              <ul class="mega-links">
                <li><a href="#">Personal Email</a></li>
                <li><a href="#">Business Email</a></li>
                <li><a href="#">Mobile Email</a></li>
                <li><a href="#">Web Marketing</a></li>
              </ul>
            </div>
            <div class="row">
              <header>Security services</header>
              <ul class="mega-links">
                <li><a href="#">Site Seal</a></li>
                <li><a href="#">VPS Hosting</a></li>
                <li><a href="#">Privacy Seal</a></li>
                <li><a href="#">Website design</a></li>
              </ul>
            </div>
          </div>
        </div>
      </li>
      <li><a href="#">Feedback</a></li>
    </ul>
    <label for="menu-btn" class="btn menu-btn"><i class="fas fa-bars"></i></label>
  </div>
</nav>
            <section>
  <img src="https://scontent.ftun1-2.fna.fbcdn.net/v/t39.30808-6/327289319_872385490699042_7371564145043347582_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=5f2048&_nc_ohc=gRnsoOScd1sQ7kNvgGinMFp&_nc_ht=scontent.ftun1-2.fna&oh=00_AfASgNCKnQF92pIrhDJoO7UH0pK87qSQkfgQQK4NH8chZw&oe=663B6F90" alt="Hero Image">
    <div class="container">
     
        
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>">
            <select id="time" name="time" required>
                <option value="" selected disabled>Choisir l'heure</option> <!-- Add this line -->
                <?php
                $start_time = strtotime("08:00");
                $end_time = strtotime("17:00");
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

            <input type="submit" name="reserver" value="Reserver">

        </form>
    </div>
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
    xhr.open("GET", "fetch.php?date=" + date, true);
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
