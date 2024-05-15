<?php
// Password
$password = "PREANESTHESIE2024";

// Check if password is submitted
if (isset($_POST['password'])) {
    $enteredPassword = $_POST['password'];
    
    // If password is correct, proceed to display the page content
    if ($enteredPassword === $password) {
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
        }}}

// Get current date and time
$currentDateTime = date('Y-m-d H:i:s');

// Query the database for reservations where date and time are greater than now
$sqlFuture = "SELECT * FROM consultation_médecine WHERE CONCAT(date, ' ', time) > '$currentDateTime'";
$resultFuture = $conn->query($sqlFuture);

// Query the database for reservations where date and time are less than or equal to now
$sqlPast = "SELECT * FROM consultation_médecine WHERE CONCAT(date, ' ', time) <= '$currentDateTime'";
$resultPast = $conn->query($sqlPast);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Reservations</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Admin Page - Reservations</h1>

    <h2>Future Reservations</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Description</th>
            <th>Date de Naissance</th>
            <th>Image</th>
        </tr>
        <?php
        if ($resultFuture->num_rows > 0) {
            while ($row = $resultFuture->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['time']}</td>";
                echo "<td>{$row['nom']}</td>";
                echo "<td>{$row['prenom']}</td>";
                echo "<td>{$row['telephone']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['dob']}</td>";
                echo "<td><img src='uploads/{$row['img']}' alt='Reservation Image' width='100'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No future reservations found</td></tr>";
        }
        ?>
    </table>

    <h2>Past Reservations</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Description</th>
            <th>Date de Naissance</th>
            <th>Image</th>
        </tr>
        <?php
        if ($resultPast->num_rows > 0) {
            while ($row = $resultPast->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['time']}</td>";
                echo "<td>{$row['nom']}</td>";
                echo "<td>{$row['prenom']}</td>";
                echo "<td>{$row['telephone']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td>{$row['dob']}</td>";
                echo "<td><img src='uploads/{$row['img']}' alt='Reservation Image' width='100'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No past reservations found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>
