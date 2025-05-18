<?php
include "db.php";

function sanitize($data)
{
    global $conn;
    return $conn->real_escape_string(trim($data));
}

// Get form data & sanitize
$id = intval($_POST['student_id']);
$name = sanitize($_POST['name']);

$subs = [
    sanitize($_POST['sub1']),
    sanitize($_POST['sub2']),
    sanitize($_POST['sub3']),
    sanitize($_POST['sub4'])
];

$mse = [
    floatval($_POST['mse1']),
    floatval($_POST['mse2']),
    floatval($_POST['mse3']),
    floatval($_POST['mse4'])
];

$ese = [
    floatval($_POST['ese1']),
    floatval($_POST['ese2']),
    floatval($_POST['ese3']),
    floatval($_POST['ese4'])
];

// Check if student already exists to avoid duplicates
$check = $conn->query("SELECT * FROM students WHERE student_id=$id");
if ($check->num_rows == 0) {
    $conn->query("INSERT INTO students VALUES ($id, '$name')");
    $conn->query("INSERT INTO mse_marks VALUES ($id, {$mse[0]}, {$mse[1]}, {$mse[2]}, {$mse[3]})");
    $conn->query("INSERT INTO ese_marks VALUES ($id, {$ese[0]}, {$ese[1]}, {$ese[2]}, {$ese[3]})");
} else {
    echo "<p><strong>Warning:</strong> Student with ID $id already exists. Using existing data for calculation.</p>";
}

// Calculate final marks and display results
echo "<h2>Final Result for $name (ID: $id)</h2>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
echo "<tr><th>Subject</th><th>MSE (30%)</th><th>ESE (70%)</th><th>Final Marks (out of 100)</th></tr>";

$total = 0;

for ($i = 0; $i < 4; $i++) {
    $final = round($mse[$i] * 0.3 + $ese[$i] * 0.7, 2);
    $total += $final;

    echo "<tr>
        <td>" . htmlspecialchars($subs[$i]) . "</td>
        <td>{$mse[$i]}</td>
        <td>{$ese[$i]}</td>
        <td>$final</td>
    </tr>";
}

$avg = round($total / 4, 2);
echo "</table>";
echo "<h3>Total Marks: $total / 400</h3>";
echo "<h3>Average Marks: $avg</h3>";
echo "<h3>Status: " . ($avg >= 40 ? "<span style='color:green'>Pass</span>" : "<span style='color:red'>Fail</span>") . "</h3>";
