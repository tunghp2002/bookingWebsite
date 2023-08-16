<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Lấy dữ liệu từ form đặt phòng
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$roomId = $_POST['roomId'];

// Tính toán tổng giá tiền
$date1 = strtotime($checkin);
$date2 = strtotime($checkout);
$days = ($date2 - $date1) / (60 * 60 * 24);
$query = "SELECT room_price FROM rooms WHERE room_id = $roomId";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$totalPrice = $days * $row['room_price'];


$query = "SELECT * FROM bookings WHERE room_id = $roomId AND ((check_in_date < '$checkin' AND check_out_date > '$checkin') OR (check_in_date > '$checkin' AND check_in_date < '$checkout'))";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) { echo "<script>alert('Phòng đã được đặt trong thời gian từ `$checkin` đến `$checkout`, vui lòng chọn phòng khác hoặc chọn thời gian khác.');</script>";
} else {
  // Thực hiện truy vấn SQL để thêm thông tin đặt phòng vào bảng bookings
  $sql1 = "INSERT INTO bookings (room_id, guest_name, email, phone, check_in_date, check_out_date, total_price) VALUES ('$roomId','$name','$email','$phone', '$checkin', '$checkout', '$totalPrice')";
  mysqli_query($conn, $sql1);

  // Thực hiện truy vấn SQL để cập nhật trường room_booked trong bảng rooms
  $sql2 = "UPDATE rooms SET room_booked = 1, check_in_date = '$checkin', check_out_date = '$checkout' WHERE room_id = '$roomId'";
  mysqli_query($conn, $sql2);

  $message = "Đặt phòng thành công!";
  echo "<script>alert('$message');</script>";
  echo "<script>setTimeout(\"location.href = 'index.php';\",500);</script>";
}
mysqli_close($conn);
?>