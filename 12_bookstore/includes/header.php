<?php session_start(); ?>
<nav>
    <a href="index.php">Home</a> |
    <a href="catalogue.php">Catalogue</a> |
    <?php if (isset($_SESSION['user'])): ?>
        Welcome, <?= $_SESSION['user'] ?> | <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
    <?php endif; ?>
</nav>