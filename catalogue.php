<?php
session_start();
include 'db.php';

// Handle "Add to Cart"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_id'])) {
    $item_id = $_POST['item_id'];
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id]++;
    } else {
        $_SESSION['cart'][$item_id] = 1;
    }

    $message = "Item added to cart!";
}

// Fetch items from DB
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Catalogue</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .item {
            border: 1px solid #ccc;
            padding: 15px;
            margin: 10px;
            display: inline-block;
            width: 200px;
            vertical-align: top;
        }

        .item img {
            max-width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .item h3 {
            margin: 5px 0;
        }

        .btn {
            padding: 6px 10px;
            background-color: green;
            color: white;
            border: none;
            margin-top: 10px;
            cursor: pointer;
        }

        .msg {
            color: green;
        }
    </style>
</head>

<body>

    <h2>Item Catalogue</h2>
    <a href="index.php">← Back to Home</a>

    <?php if (isset($message)) echo "<p class='msg'>$message</p>"; ?>

    <div>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="item">
                <img src="<?= $row['image_url'] ?>" alt="<?= $row['name'] ?>">
                <h3><?= $row['name'] ?></h3>
                <p>Price: ₹<?= $row['price'] ?></p>
                <p>Stock: <?= $row['quantity'] ?></p>
                <!-- Add Item Button -->
                <form method="POST">
                    <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn">Add Item</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

</body>

</html>
<a href="cart.php" class="btn">🛒 View Cart</a>