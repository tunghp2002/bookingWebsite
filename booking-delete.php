<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET["id"])) {
    $booking_id = $_GET["id"];
    // Cập nhật lại trạng thái phòng đã trống
    $sql_update = "UPDATE rooms 
                    INNER JOIN bookings ON rooms.room_id = bookings.room_id 
                    SET room_booked = 0, rooms.check_in_date = null, rooms.check_out_date = null 
                    WHERE bookings.booking_id = '$booking_id'";
    if ($conn->query($sql_update) === TRUE) {
        // Xóa dữ liệu từ bảng bookings
        $sql_delete = "DELETE FROM bookings WHERE booking_id = '$booking_id'";
        if ($conn->query($sql_delete) === TRUE) {
            $message = "Xóa phòng thành công!";
            echo "<script>alert('$message');</script>";
            echo "<script>setTimeout(\"location.href = 'booking-manage.php';\",500);</script>";
        } else {
            echo "<div class='result'>Lỗi khi xóa phòng đặt: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='result'>Lỗi khi cập nhật trạng thái phòng: " . $conn->error . "</div>";
    }
}

$conn->close()
?>