<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Grocery Shop - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        nav a {
            margin-right: 10px;
            text-decoration: none;
            color: darkblue;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <h1>Welcome to the Grocery Shop</h1>

    <nav>
        <a href="index.php">Home</a>
        <a href="catalogue.php">Catalogue</a>
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        <?php endif; ?>
    </nav>

    <!-- ✅ Add Item Button -->
    <?php if (isset($_SESSION['user'])): ?>
        <a href="add_item.php" class="btn">➕ Add Item</a>
    <?php endif; ?>

</body>

</html>
<a href="cart.php" class="btn">🛒 View Cart</a>