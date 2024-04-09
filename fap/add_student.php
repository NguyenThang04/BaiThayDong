<?php
$_servername = "localhost";
$_username = "root";
$_password = "";
$_dbname = "btec-student";

// Create connection
$connection = new mysqli($_servername, $_username, $_password, $_dbname);

$id = "";
$MaSV = "";
$fullname = "";
$email = "";
$password = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $MaSV = $_POST['MaSV'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $check_sql = "SELECT * FROM users WHERE email = '$email'";
    $check_result = $connection->query($check_sql);

    if ($check_result->num_rows > 0) {
        $errorMessage = "Error: Email already exists in the system.";
    } else {
        if (empty($id) || empty($MaSV) || empty($fullname) || empty($email) || empty($password)) {
            $errorMessage = "Complete student information is required";
        } else {
            // Add new student to the database
            $stmt = $connection->prepare("INSERT INTO users (id, MaSV, fullname, email, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $id, $MaSV, $fullname, $email, $hashed_password);

            if ($stmt->execute()) {
                $id = "";
                $MaSV = "";
                $fullname = "";
                $email = "";
                $password = "";
                $successMessage = "Student added correctly";

                header("location: /fap/home_page.php");
                exit;
            } else {
                $errorMessage = "Error executing query: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin-top: 50px;
        }
        .form-group label {
            font-weight: bold;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .success-message {
            color: green;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Add Student</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text" name="id" class="form-control" value="<?php echo htmlspecialchars($id); ?>">
            </div>

            <div class="mb-3">
                <label for="MaSV" class="form-label">MaSV:</label>
                <input type="text" name="MaSV" class="form-control" value="<?php echo htmlspecialchars($MaSV); ?>">
            </div>

            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name:</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($fullname); ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add Student</button>
                <a class="btn btn-secondary" href="/fap/home_page.php" role="button">Cancel</a>
            </div>
        </form>

        <?php
        if (!empty($errorMessage)) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        }

        if (!empty($successMessage)) {
            echo '<p class="success-message">' . $successMessage . '</p>';
        }
        ?>
    </div>
</body>
</html>