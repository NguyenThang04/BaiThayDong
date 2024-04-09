<!DOCTYPE html>
<html>
<head>
    <style>
        /* Table Styles */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr.rainbow-row {
            animation: rainbow 5s infinite;
        }
        tr:hover {
            background-color: #e5e5e5;
        }

        /* Heading Style */
        h2 {
            color: #333;
            background-color: #f2f2f2;
            padding: 10px;
            margin-bottom: 20px;
        }

        /* Rainbow Animation */
        @keyframes rainbow {
            0% { background-color: red; }
            14% { background-color: orange; }
            28% { background-color: yellow; }
            42% { background-color: green; }
            57% { background-color: blue; }
            71% { background-color: indigo; }
            85% { background-color: violet; }
            100% { background-color: red; }
        }
    </style>
</head>
<body>

<?php

        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "btec-student";

        // Create a connection
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check if the connection was successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Execute the SELECT query
        $query = "SELECT * FROM students";
        $result = mysqli_query($conn, $query);

        // Check if the query was successful
        if ($result) {
            // Fetch all rows as an associative array
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    ?>
    <h2>Students</h2>
    <table>
        <tr>
            <th>Roll No</th>
            <th>Name</th>
            <th>Address</th>
            <th>Email</th>
        </tr>
        <?php $index = 0; ?>
        <?php foreach ($rows as $row) { ?>
            <tr class="<?php echo ($index % 2 == 0) ? 'rainbow-row' : ''; ?>">
                <td><?php echo $row['Rollno']; ?></td>
                <td><?php echo $row['Stname']; ?></td>
                <td><?php echo $row['Address']; ?></td>
                <td><?php echo $row['Email']; ?></td>
            </tr>
            <?php $index++; ?>
        <?php } ?>
    </table>
</body>
</html>