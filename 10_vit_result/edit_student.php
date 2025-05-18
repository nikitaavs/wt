<?php include 'db.php';

$id = $_GET['id'];
$student = $conn->query("SELECT * FROM students WHERE id = $id")->fetch_assoc();
$mse = $conn->query("SELECT * FROM mse WHERE student_id = $id")->fetch_assoc();
$ese = $conn->query("SELECT * FROM ese WHERE student_id = $id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3>Edit Student: <?php echo $student['name']; ?></h3>
        <form method="post">
            <h5>MSE Marks</h5>
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <input class="form-control mb-2" name="m<?php echo $i; ?>" value="<?php echo $mse["subject$i"]; ?>" required>
            <?php endfor; ?>
            <h5>ESE Marks</h5>
            <?php for ($i = 1; $i <= 4; $i++): ?>
                <input class="form-control mb-2" name="e<?php echo $i; ?>" value="<?php echo $ese["subject$i"]; ?>" required>
            <?php endfor; ?>
            <button type="submit" name="update" class="btn btn-primary mt-3">Update</button>
            <a href="index.php" class="btn btn-secondary mt-3">Cancel</a>
        </form>
    </div>

    <?php
    if (isset($_POST['update'])) {
        for ($i = 1; $i <= 4; $i++) {
            $m[$i] = $_POST["m$i"];
            $e[$i] = $_POST["e$i"];
        }

        $conn->query("UPDATE mse SET subject1=$m[1], subject2=$m[2], subject3=$m[3], subject4=$m[4] WHERE student_id=$id");
        $conn->query("UPDATE ese SET subject1=$e[1], subject2=$e[2], subject3=$e[3], subject4=$e[4] WHERE student_id=$id");
        header("Location: index.php");
    }
    ?>
</body>

</html>