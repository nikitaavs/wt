<?php
session_start();
include 'db.php';

// Remove individual item
if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
}

// Empty entire cart
if (isset($_GET['empty'])) {
    unset($_SESSION['cart']);
}

// If cart is empty
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$total = 0;
$items_data = [];

if (!empty($cart_items)) {
    $ids = implode(",", array_keys($cart_items));
    $sql = "SELECT * FROM items WHERE id IN ($ids)";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $item_id = $row['id'];
        $quantity = $cart_items[$item_id];
        $row['quantity_selected'] = $quantity;
        $row['subtotal'] = $quantity * $row['price'];
        $total += $row['subtotal'];
        $items_data[] = $row;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Your Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .btn {
            padding: 6px 10px;
            background-color: green;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-right: 10px;
        }

        .btn-danger {
            background-color: red;
        }

        .btn-empty {
            background-color: darkorange;
        }
    </style>
</head>

<body>

    <h2>🛒 Your Shopping Cart</h2>
    <a href="index.php" class="btn">← Back to Home</a>
    <a href="catalogue.php" class="btn">Continue Shopping</a>

    <?php if (empty($items_data)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Item</th>
                <th>Price (₹)</th>
                <th>Quantity</th>
                <th>Subtotal (₹)</th>
                <th>Action</th>
            </tr>
            <?php foreach ($items_data as $item): ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['quantity_selected'] ?></td>
                    <td><?= $item['subtotal'] ?></td>
                    <td>
                        <a href="cart.php?remove=<?= $item['id'] ?>" class="btn btn-danger">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td colspan="2"><strong>₹<?= $total ?></strong></td>
            </tr>
        </table>
        <br>
        <a href="cart.php?empty=1" class="btn btn-empty">Empty Cart</a>
    <?php endif; ?>

</body>

</html>