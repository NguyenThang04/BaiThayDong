<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <title>Product List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container my-5">
        <h2>List of Students</h2>
        <a class="btn btn-primary" href="/fap/add_student.php" role="button"> New Students</a>
        <br>

        <table class="table">
        <thead>
        <tr>
          <th class="border-b">ID</th>
          <th class="MaSV-b">MaSV</th>
          <th class="border-b">Fullname</th>
          <th class="border-b">Email</th>
          <th class="border-b">Password</th>
        </tr>
      </thead>
        <tbody>
          <?php
             // Database connection settings
            $_servername = "localhost";
            $_username = "root";
            $_password = "";
            $_dbname = "btec-student";

            //Create connection;
            $conn = new mysqli($_servername, $_username, $_password, $_dbname);
          
            //Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            // // Read all row from database table
            $query = "SELECT * FROM users";
            $result = $conn->query($query);

            if (!$result) {
              die("invalid query: "  .  $connection->error);
            }

            //Read data of each row
            while($row = $result->fetch_assoc()){
              echo"
              <tr>
              <td>$row[id]</td>
              <td>$row[MaSV]</td>
              <td>$row[fullname]</td>
              <td>$row[email]</td>
              <td>$row[password]</td>
              <td>
                <a class='btn btn-primary btn-sm' href='/fap/edit_student.php?id=$row[id]'>Update</a>
                <a class='btn btn-primary btn-sm' href='/fap/delete_student.php?id=$row[id]'>Delete</a>
              </td>
            </tr>
              ";
          }
          ?>
        </tbody>
      </table>
    </div>
</body>
</html>