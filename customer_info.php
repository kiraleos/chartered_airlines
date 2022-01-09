<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chartered Airlines - Customer Info</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <img src="assets/logo.png" class="logo">
    <div class="navbar">
        <a href="index.php">Flights</a>
        <a href="reservations.php">Reservations</a>
        <a class="current" href="customer_info.php ">Customer Information</a>
    </div>
    <div class="has-text">
        <form action="customer_info.php" method="post">
            <label for="customer-id" class="input-label">Customer ID</label>
            <br>
            <input type="text" name="customer_id" pattern="[0-9]+" required="required"><br>
            <br>
            <label for="date" class="input-label">Date</label>
            <br>
            <input type="date" name="date" required="required" pattern="\d{1,2}/\d{1,2}/\d{4}"><br><br>
            <input type="submit" value="Submit" class="button long-button">
        </form>
        <br>
        <table>
            <tr>
                <th>Number of reservations</th>
                <th>Total cost for that month</th>
            </tr>
            <?php
            if (isset($_POST['customer_id']) and isset($_POST['date'])) {
                $customer_id = $_POST['customer_id'];
                $month = date("m", strtotime($_POST['date']));
                $mysqli = new mysqli('localhost', 'username', 'password', 'database_name') or die(mysqli_error($mysqli));
                $result = $mysqli->query("SELECT * FROM reservations where customer_id = $customer_id and MONTH(reservation_date) = $month") or die($mysqli->error);
                echo "<tr><td>$result->num_rows " . "</td>";
                $result = $mysqli->query("SELECT SUM(cost) from reservations where customer_id = $customer_id and MONTH(reservation_date) = $month GROUP BY customer_id") or die($mysqli->error);
                $row = mysqli_fetch_assoc($result);
                echo "<td>" . number_format($row['SUM(cost)'], 2) . "€</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>