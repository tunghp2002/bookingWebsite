<style>
    table {
        border-collapse: collapse;
        width: 100%;
        border: solid 1px;
        line-height: 10px;
        font-size: 15px;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #ddd;
        font-weight: bold;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-bottom: 30px;
        margin-top: 30px;
        width: 100%;
        height: 40px;
        font-size: 20px;
    }

    label {
        display: inline-block;
        width: 200px;
        font-size: 20px;
        padding: 5px;
    }
</style>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['save'])) {
    // Lấy dữ liệu từ form sửa phòng
    $guest_name = $_POST['guest_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $room_id = $_POST['room_id'];

    // Cập nhật thông tin phòng trong cơ sở dữ liệu
    $sql = "UPDATE bookings SET guest_name='$guest_name', email='$email', phone='$phone', check_in_date='$check_in_date', check_out_date='$check_out_date', room_beds='$room_beds', room_capacity='$room_capacity', room_amenities='$room_amenities' WHERE room_id='$room_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thông tin đơn đặt thành công thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
}


if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Lấy thông tin phòng từ cơ sở dữ liệu
    $sql = "SELECT * FROM bookings WHERE booking_id='$booking_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Hiển thị form sửa phòng
        echo "<h2>Sửa thông tin phòng:</h2>
                  <form method='post'>
                      <input type='hidden' name='booking_id' value='" . $row["booking_id"] . "'>
                      <label for='guest_name'>Guest's Name:</label>
                      <input type='text' name='guest_name' value='" . $row["guest_name"] . "' required><br>
                      <label for='email'>Email:</label>
                      <input type='text' name='email' value='" . $row["email"] . "' required><br>
                      <label for='phone'>Phone:</label>
                      <input type='text' name='phone' value='" . $row["phone"] . "' required><br>
                      <label for='check_in_date'>Check-in:</label>
                      <input type='text' name='check_in_date' value='" . $row["check_in_date"] . "' required><br>
                      <label for='check_out_date'>Check-out:</label>
                      <input type='text' name='check_out_date' value='" . $row["check_out_date"] . "' required><br>
                      <label for='room_beds'>Room_id:</label>
                      <input type='text' name='room_id' value='" . $row["room_id"] . "' required><br>
                      <input type='submit' name='submit' value='Update Room'>
                      </form>";
    } else {
        echo "0 results";
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["submit"])) {
    $booking_id = $_POST["booking_id"];
    $guest_name = $_POST['guest_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $room_id = $_POST['room_id'];

    // Cập nhật dữ liệu phòng vào bảng rooms
    $sql = "UPDATE bookings SET 
    guest_name = '$guest_name', 
    email = '$email', 
    phone = '$phone', 
    check_in_date = '$check_in_date', 
    check_out_date = '$check_out_date', 
    room_id = '$room_id' 
    WHERE booking_id = '$booking_id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Cập nhật đơn thành công!";
        echo "<script>alert('$message');</script>";
        echo "<script>setTimeout(\"location.href = 'booking-manage.php';\",500);</script>";
    } else {
        echo "Lỗi. " . $conn->error;
    }
}

$conn->close();
?>