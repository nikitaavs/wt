<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>VIT Results Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .container {
            margin-top: 50px;
        }

        .btn {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>🎓 VIT Student Semester Results</h2>
            <a href="add_student.php" class="btn btn-success">+ Add Student</a>
        </div>
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Sub1</th>
                    <th>Sub2</th>
                    <th>Sub3</th>
                    <th>Sub4</th>
                    <th>Total</th>
                    <th>Avg</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT students.id, students.name,
                  mse.subject1 AS m1, mse.subject2 AS m2, mse.subject3 AS m3, mse.subject4 AS m4,
                  ese.subject1 AS e1, ese.subject2 AS e2, ese.subject3 AS e3, ese.subject4 AS e4
              FROM students
              JOIN mse ON students.id = mse.student_id
              JOIN ese ON students.id = ese.student_id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $total = 0;
                        for ($i = 1; $i <= 4; $i++) {
                            $m = $row["m$i"];
                            $e = $row["e$i"];
                            $marks[$i] = round(($m * 0.3) + ($e * 0.7), 2);
                            $total += $marks[$i];
                        }
                        $avg = round($total / 4, 2);
                        echo "<tr>
                      <td>{$row['name']}</td>
                      <td>{$marks[1]}</td><td>{$marks[2]}</td><td>{$marks[3]}</td><td>{$marks[4]}</td>
                      <td>$total</td><td>$avg</td>
                      <td>
                          <a href='edit_student.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                          <a href='delete_student.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirmDelete();'>Delete</a>
                      </td>
                    </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No student records found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this student?");
        }
    </script>
</body>

</html>