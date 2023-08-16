<!DOCTYPE html>
<html>

<head>
    <title>Booking</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        max-width: 100%;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        border: solid 1px;
        line-height: 10px;
        font-size: 10px;
    }

    th,
    td {
        text-align: left;
        padding: 8px;
        line-height: 20px;
        text-align: center;
        font-size: 15px;
    }

    th {
        background-color: #ddd;
        font-weight: bold;
    }

    td {
        font-size: 15px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        height: 30px;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }


    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: left;
        margin-bottom: 30px;
        margin-top: 15px;
        width: 30%;
        height: 40px;
        font-size: 20px;
    }

    input[type="file"] {
        font-size: 15px;
    }


    label {
        display: inline-block;
        width: 200px;
        font-size: 15px;
        padding: 2px;
    }

    a {
        color: #008CBA;
        text-decoration: none;
        font-size: 15px;
        line-height: 30px;
    }

    a:hover {
        color: #005580;
    }

    .row {
        margin: 10px, 0;
    }

    .col-2 {
        background-color: #091D29;
        position: fixed;
        height: 100%;
    }

    .col-2 a {
        color: white;
        padding: 15px;
        line-height: 50px;
    }

    .col-2 hr {
        background-color: white;
    }

    .col-2 a:hover {
        color: #4CAF50;
        text-decoration: none;
    }

    .admin-info {
        color: white;
        text-align: center;
    }

    .admin-info p {
        color: white;
        font-size: 30px;
    }

    .col-9 {
        margin-left: 240px;
    }
</style>

<body>
    <div class="row">
        <div class="col-2">
            <div class="admin-info">
                <span id="boot-icon" class="fa fa-person-circle" style="font-size:10px"></span>
                <p>Crowny Hotel</p>
                <p>Admin</p>
            </div>
            <hr>
            <span id="boot-icon" class="fa fa-h-circle" style="font-size:10px"></span>
            <a href="./room-manage.php">Quản lý phòng</a><br>
            <span id="boot-icon" class="fa fa-people" style="font-size:10px"></span>
            <a href="./booking-manage.php">Quản lý đơn đặt</a>
        </div>
        <div class="col-9">
            <h2>Booking Management</h2>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hotel";


            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Lấy danh sách phòng từ bảng rooms
            $sql = "SELECT bookings.*, rooms.room_number FROM bookings INNER JOIN rooms ON bookings.room_id = rooms.room_id";
            $result = $conn->query($sql);

            // Hiển thị danh sách phòng trong bảng
            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>
           <tr>
               <th>Booking ID</th>
               <th>Guest's Name</th>
               <th>Email</th>
               <th>Phone</th>
               <th>Room Number</th>
               <th>Check-in Date</th>
               <th>Check-out Date</th>
               <th>Total Price</th>
               <th>Action</th>
           </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
               <td>" . $row["booking_id"] . "</td>
               <td>" . $row["guest_name"] . "</td>
               <td>" . $row["email"] . "</td>
               <td>" . $row["phone"] . "</td>
               <td>" . $row["room_number"] . "</td>
               <td>" . $row["check_in_date"] . "</td>
               <td>" . $row["check_out_date"] . "</td>
               <td>" . $row["total_price"] . "</td>
               <td><a href='booking-edit.php?id=" . $row["booking_id"] . "'>Sửa</a> 
            <a href='booking-delete.php?id=" . $row["booking_id"] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa phòng này?');\">Xóa</a></td>
           </tr>";
                }

                echo "</table>";
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
        </div>
</body>

</html>