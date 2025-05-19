<?php
session_start();
include 'db.php';

$result = $conn->query("SELECT * FROM items");
?>
<!DOCTYPE html>
<html>

<head>
    <title>Catalogue</title>
    <style>
        .item-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            width: 200px;
        }

        .catalogue-grid {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
</head>

<body>
    <h2>Grocery Items</h2>
    <nav>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>

    <div class="catalogue-grid">
        <?php while ($item = $result->fetch_assoc()): ?>
            <div class="item-card">
                <img src="<?= $item['image_url'] ?>" width="100"><br>
                <strong><?= $item['name'] ?></strong><br>
                Price: ₹<?= $item['price'] ?><br>
                Quantity: <?= $item['quantity'] ?><br>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>