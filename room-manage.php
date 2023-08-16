<!DOCTYPE html>
<html>

<head>
    <title>Rooms</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        max-width: 1440px;
    }

    table {
        border-collapse: collapse;
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
        font-size: 14px;
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
        margin-left: 215px;
    }

    .result {
        color: red;
        font-size: 20px;
        text-align: center;
    }
</style>

<body>
    <?php
        // Gọi hàm updateRoomStatus() để cập nhật trạng thái của phòng
        require_once './auto-update.php';
        updateRoomStatus();
    ?>
    <div class="row">
        <div class="col-2">
            <div class="admin-info">
                <span id="boot-icon" class="bi bi-person-circle" style="font-size:10px"></span>
                <p>Crowny Hotel</p>
                <p>Admin</p>
            </div>
            <hr>
            <span id="boot-icon" class="bi bi-h-circle" style="font-size:10px"></span>
            <a href="./room-manage.php">Quản lý phòng</a><br>
            <span id="boot-icon" class="bi bi-people" style="font-size:10px"></span>
            <a href="./booking-manage.php">Quản lý đơn đặt</a>
        </div>
        <div class="col-9">
            <h2>Rooms Management</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label>Số phòng:</label>
                <input type="number" name="room_number" required><br>

                <label>Tên phòng:</label>
                <input type="text" name="room_name" required><br>

                <label>Loại phòng:</label>
                <input type="text" name="room_type" required><br>

                <label>Giá phòng:</label>
                <input type="number" name="room_price" required><br>


                <label>View:</label>
                <input type="text" name="room_view" required><br>

                <label>Số giường:</label>
                <input type="number" name="room_beds" required><br>


                <label>Sức chứa:</label>
                <input type="number" name="room_capacity" required><br>

                <label>Dịch vụ:</label>
                <textarea name="room_amenities" rows="" required></textarea><br>

                <label>Ảnh phòng:</label>
                <input type="file" name="room_image" required><br>
                <input type="submit" value="Thêm">
            </form>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hotel";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM rooms";
            $result = $conn->query($sql);

            // Hiển thị danh sách phòng trong bảng
            if ($result->num_rows > 0) {
                echo "<table class='table table-bordered'>
           <tr>
               <th>Room ID</th>
               <th>Room Number</th>
               <th>Room Name</th>
               <th>Room Type</th>
               <th>Room Price</th>
               <th>Room Booked</th>
               <th>Check-in Date</th>
               <th>Check-out Date</th>
               <th>Room Image</th>
               <th>Room View</th>
               <th>Room Beds</th>
               <th>Room Capacity</th>
               <th>Room Amenities</th>
               <th>Action</th>
           </tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
               <td>" . $row["room_id"] . "</td>
               <td>" . $row["room_number"] . "</td>
               <td>" . $row["room_name"] . "</td>
               <td>" . $row["room_type"] . "</td>
               <td>" . $row["room_price"] . "</td>
               <td>" . $row["room_booked"] . "</td>
               <td>" . $row["check_in_date"] . "</td>
               <td>" . $row["check_out_date"] . "</td>
               <td><img src='uploads/" . $row["room_image"] . "' width='100px'></td>
               <td>" . $row["room_view"] . "</td>
               <td>" . $row["room_beds"] . "</td>
               <td>" . $row["room_capacity"] . "</td>
               <td>" . $row["room_amenities"] . "</td>
               <td><a href='edit.php?id=" . $row["room_id"] . "'>Sửa</a> 
            <a href='delete.php?id=" . $row["room_id"] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xóa phòng này?');\">Xóa</a></td>
           </tr>";
                }

                echo "</table>";
            } else {
                echo "0 results";
            }

            // Thêm phòng
            if (isset($_POST['room_number'])) {
                // Lấy thông tin phòng từ biểu mẫu và kiểm tra tính hợp lệ của chúng
                $room_number = $_POST['room_number'];
                $room_name = $_POST['room_name'];
                $room_type = $_POST['room_type'];
                $room_price = $_POST['room_price'];
                $room_view = $_POST['room_view'];
                $room_beds = $_POST['room_beds'];
                $room_capacity = $_POST['room_capacity'];
                $room_amenities = $_POST['room_amenities'];
                $room_image = $_FILES['room_image']['name'];

                // Đường dẫn đến thư mục lưu trữ ảnh phòng
                $target_dir = "uploads/";
                // Lưu trữ ảnh phòng vào thư mục uploads
                $target_file = $target_dir . basename($_FILES["room_image"]["name"]);
                move_uploaded_file($_FILES["room_image"]["tmp_name"], $target_file);

                // Tạo câu lệnh SQL để chèn thông tin phòng mới vào bảng rooms trong cơ sở dữ liệu
                $sql = "INSERT INTO rooms (room_number, room_name, room_type, room_price, room_view, room_beds, room_capacity, room_amenities, room_image) 
            VALUES ('$room_number', '$room_name', '$room_type', '$room_price', '$room_view', '$room_beds', '$room_capacity', '$room_amenities', '$room_image')";

                if ($conn->query($sql) === TRUE) {
                    $message = "Thêm phòng mới thành công!";
                    echo "<script>alert('$message');</script>";
                } else {
                    echo "Lỗi khi thêm phòng mới: " . $conn->error;
                }
            }
            // Lấy danh sách các phòng đã check-out trước đó nhưng chưa được cập nhật
            $sql = "SELECT * FROM rooms WHERE room_booked = 1 AND check_out_date < CURDATE()";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Duyệt qua từng phòng đã check-out và cập nhật trạng thái thành 0
                while ($row = $result->fetch_assoc()) {
                    $sql_update = "UPDATE rooms SET room_booked = 0, check_in_date = null, check_out_date = null WHERE room_id = " . $row["room_id"];
                    if ($conn->query($sql_update) === TRUE) {
                    } else {
                        echo "Cập nhật thông tin phòng thất bại " . $conn->error;
                    }
                }
            }

            $conn->close();
            ?>
        </div>
</body>

</html>