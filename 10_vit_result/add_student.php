<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3>Add New Student</h3>
        <form method="post">
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <h5>MSE Marks (out of 30)</h5>
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <input class="form-control mb-2" name="m<?php echo $i; ?>" placeholder="Subject <?php echo $i; ?>" required>
            <?php endfor; ?>
            <h5>ESE Marks (out of 70)</h5>
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <input class="form-control mb-2" name="e<?php echo $i; ?>" placeholder="Subject <?php echo $i; ?>" required>
            <?php endfor; ?>
            <button type="submit" name="submit" class="btn btn-primary mt-3">Add Student</button>
            <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $m = array($_POST['m1'], $_POST['m2'], $_POST['m3'], $_POST['m4']);
        $e = array($_POST['e1'], $_POST['e2'], $_POST['e3'], $_POST['e4']);

        $conn->query("INSERT INTO students (name) VALUES ('$name')");
        $id = $conn->insert_id;

        $conn->query("INSERT INTO mse (student_id, subject1, subject2, subject3, subject4)
                  VALUES ($id, $m[0], $m[1], $m[2], $m[3])");

        $conn->query("INSERT INTO ese (student_id, subject1, subject2, subject3, subject4)
                  VALUES ($id, $e[0], $e[1], $e[2], $e[3])");

        header("Location: index.php");
    }
    ?>
</body>

</html>