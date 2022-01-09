<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chartered Airlines - Flights</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img src="assets/logo.png" class="logo">
    <div class="navbar">
        <a class="current" href="index.php">Flights</a>
        <a href="reservations.php">Reservations</a>
        <a href="customer_info.php ">Customer Information</a>
    </div>
    <div class="has-text">
        <?php
        $mysqli = new mysqli('localhost', 'username', 'password', 'database_name') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM flights") or die($mysqli->error);
        ?>
        <table>
            <tr>
                <th>Flight #</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Flight Type</th>
                <th>Seats</th>
                <th>Free Seats</th>
                <th>Flight Date</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>$row[flight_no]</td><td>$row[departure]</td><td>$row[arrival]</td><td>$row[flight_type]</td><td>$row[seats]</td><td>$row[free_seats]</td><td>$row[flight_date]</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>