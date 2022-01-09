<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chartered Airlines - Dropdown</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img src="assets/logo.png" class="logo">
    <div class="navbar">
        <a href="index.php">Flights</a>
        <a class="current" href="reservations.php">Reservations</a>
        <a href="customer_info.php ">Customer Information</a>
    </div>
    <div class="has-text">
        <form action="reservations.php" method="post">
            <label class="dropdown-label" for="flights">Select a flight to display customers who have a reservation on that flight: </label>
            <select name="flights" id="flights">
                <?php
                $mysqli = new mysqli('localhost', 'username', 'password', 'database_name') or die(mysqli_error($mysqli));
                $result = $mysqli->query("SELECT departure, arrival, flight_no FROM flights") or die($mysqli->error);

                while ($row = mysqli_fetch_array($result)) {
                    echo "<option value=\"$row[flight_no]\">$row[departure] -> $row[arrival]</option>";
                }
                ?>
            </select>
            <input type="submit" class="button" value="Submit">
        </form>
        <br>
        <?php
        if ($flight_no = $_POST['flights']) {
            $result = $mysqli->query("SELECT first_name, last_name, nationality, date_of_birth FROM customers c INNER JOIN reservations r ON r.customer_id = c.customer_id WHERE r.flight_no = $flight_no;") or die($mysqli->error);
            echo "Customer(s) on flight $flight_no:</p>";
            echo "<table>";
            echo "<tr><th>First Name</th><th>Last Name</th><th>Nationality</th><th>Date of Birth</th></tr>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>$row[first_name]</td><td>$row[last_name]</td><td>$row[nationality]</td><td>$row[date_of_birth]</td></tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</body>

</html>