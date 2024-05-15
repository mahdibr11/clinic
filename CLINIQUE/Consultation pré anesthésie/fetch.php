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

// Retrieve reserved times for the specified date
$reserved_times = array();
if (isset($_GET["date"])) {
    $date = $_GET["date"];
    $sql = "SELECT time FROM consultation_médecine WHERE date = '$date'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Extract only the hour and minute part of the time
            $time = date("H:i", strtotime($row["time"]));
            $reserved_times[] = $time;
        }
    }
}

// Close database connection
$conn->close();

// Output reserved times as JSON
header('Content-Type: application/json');
echo json_encode($reserved_times);
?>
