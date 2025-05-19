<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Grocery Shop - Home</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
        }

        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: darkblue;
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
</body>

</html>