<?php
include 'includes/db.php';
include 'includes/header.php';

$result = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
    <title>Catalogue</title>
    <style>
        .catalogue {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .book {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
        }

        .book img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <h1>Book Catalogue</h1>
    <div class="catalogue">
        <?php while ($book = $result->fetch_assoc()): ?>
            <div class="book">
                <?php if (!empty($book['cover_image'])): ?>
                    <img src="<?= htmlspecialchars($book['cover_image']) ?>" alt="Book Cover">
                <?php else: ?>
                    <img src="images/placeholder.jpg" alt="No Cover">
                <?php endif; ?>
                <h3><?= htmlspecialchars($book['title']) ?></h3>
                <p><strong>Author:</strong> <?= htmlspecialchars($book['author']) ?></p>
                <p><strong>Price:</strong> $<?= $book['price'] ?></p>
                <p><?= htmlspecialchars($book['description']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>