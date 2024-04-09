<?php
// Thông tin kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btec-student";

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy ID người dùng cần xóa
$id = $_GET['id'];

// Chuẩn bị truy vấn xóa
$sql = "DELETE FROM users WHERE id = '$id'";

// Thực thi truy vấn
if ($conn->query($sql) === TRUE) {
    echo "Delete Success!";
} else {
    echo "Lỗi xóa: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>