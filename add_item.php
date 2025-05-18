<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    $sql = "INSERT INTO items (name, price, quantity, image_url)
            VALUES ('$name', '$price', '$quantity', '$image_url')";
    if ($conn->query($sql) === TRUE) {
        $message = "Item added successfully!";
    } else {
        $error = "Error adding item: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Item</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        form {
            max-width: 400px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
        }

        .btn {
            margin-top: 15px;
            background-color: green;
            color: white;
            padding: 10px;
            border: none;
        }
    </style>
</head>

<body>
    <h2>Add New Grocery Item</h2>
    <form method="POST">
        <label>Item Name:</label>
        <input type="text" name="name" required>

        <label>Price (₹):</label>
        <input type="number" step="0.01" name="price" required>

        <label>Quantity:</label>
        <input type="number" name="quantity" required>

        <label>Image URL:</label>
        <input type="text" name="image_url" placeholder="https://..." required>

        <button type="submit" class="btn">Add Item</button>
    </form>

    <?php
    if (isset($message)) echo "<p style='color: green;'>$message</p>";
    if (isset($error)) echo "<p style='color: red;'>$error</p>";
    ?>
</body>

</html>