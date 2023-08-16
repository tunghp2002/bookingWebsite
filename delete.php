<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$room_id = $_GET['id'];

// Thực hiện truy vấn xóa phòng
$sql = "DELETE FROM rooms WHERE room_id = $room_id";
if ($conn->query($sql) === TRUE) {
    $message = "Xóa phòng thành công!";
    echo "<script>alert('$message');</script>";
    echo "<script>setTimeout(\"location.href = 'room-manage.php';\",500);</script>";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>