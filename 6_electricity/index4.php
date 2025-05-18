<?php
// --- PHP code to handle form submission and calculate bill ---
$billMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "root"; // Default MAMP password
    $database = "electricity";

    // Connect to MySQL
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get POST data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $units = (int)$_POST['units'];

    // Calculate amount
    if ($units <= 50) {
        $amount = $units * 3.50;
    } elseif ($units <= 150) {
        $amount = 50 * 3.50 + ($units - 50) * 4.00;
    } elseif ($units <= 250) {
        $amount = 50 * 3.50 + 100 * 4.00 + ($units - 150) * 5.20;
    } else {
        $amount = 50 * 3.50 + 100 * 4.00 + 100 * 5.20 + ($units - 250) * 6.50;
    }

    // Insert into consumer
    $consumer_sql = "INSERT INTO consumer (name, address) VALUES ('$name', '$address')";
    if ($conn->query($consumer_sql) === TRUE) {
        $consumer_id = $conn->insert_id;

        // Insert into billing
        $billing_sql = "INSERT INTO billing (consumer_id, units, amount) VALUES ($consumer_id, $units, $amount)";
        if ($conn->query($billing_sql) === TRUE) {
            $billMessage = "<div class='alert alert-success'>Bill recorded successfully.<br><strong>Total Amount: ₹" . number_format($amount, 2) . "</strong></div>";
        } else {
            $billMessage = "<div class='alert alert-danger'>Error in billing: " . $conn->error . "</div>";
        }
    } else {
        $billMessage = "<div class='alert alert-danger'>Error in consumer insert: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Electricity Bill Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Electricity Bill Calculator</h2>

        <form method="POST" action="">
            <div class="mb-3">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Address:</label>
                <input type="text" name="address" class="form-control" required />
            </div>

            <div class="mb-3">
                <label class="form-label">Units Consumed:</label>
                <input type="number" name="units" class="form-control" required />
            </div>

            <button type="submit" class="btn btn-primary">Calculate Bill</button>
        </form>

        <div class="mt-4">
            <?php echo $billMessage; ?>
        </div>
    </div>

</body>

</html>