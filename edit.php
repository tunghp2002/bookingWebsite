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

    if(isset($_POST['save'])) {
        // Lấy dữ liệu từ form sửa phòng
        $room_id = $_POST['room_id'];
        $room_number = $_POST['room_number'];
        $room_name = $_POST['room_name'];
        $room_type = $_POST['room_type'];
        $room_price = $_POST['room_price'];
        $room_view = $_POST['room_view'];
        $room_beds = $_POST['room_beds'];
        $room_capacity = $_POST['room_capacity'];
        $room_amenities = $_POST['room_amenities'];

        // Cập nhật thông tin phòng trong cơ sở dữ liệu
        $sql = "UPDATE rooms SET room_number='$room_number', room_name='$room_name', room_type='$room_type', room_price='$room_price', room_view='$room_view', room_beds='$room_beds', room_capacity='$room_capacity', room_amenities='$room_amenities' WHERE room_id='$room_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Cập nhật thông tin phòng thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }
    }

    if(isset($_GET['id'])) {
        $room_id = $_GET['id'];

        // Lấy thông tin phòng từ cơ sở dữ liệu
        $sql = "SELECT * FROM rooms WHERE room_id='$room_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo "<h2>Sửa thông tin phòng:</h2>
                  <form method='post'>
                      <input type='hidden' name='room_id' value='" . $row["room_id"] . "'>
                      <label for='room_number'>Room Number:</label>
                      <input type='text' name='room_number' value='" . $row["room_number"] . "' required><br>
                      <label for='room_name'>Room Name:</label>
                      <input type='text' name='room_name' value='" . $row["room_name"] . "' required><br>
                      <label for='room_type'>Room Type:</label>
                      <input type='text' name='room_type' value='" . $row["room_type"] . "' required><br>
                      <label for='room_price'>Room Price:</label>
                      <input type='text' name='room_price' value='" . $row["room_price"] . "' required><br>
                      <label for='room_view'>Room View:</label>
                      <input type='text' name='room_view' value='" . $row["room_view"] . "' required><br>
                      <label for='room_beds'>Room Beds:</label>
                      <input type='text' name='room_beds' value='" . $row["room_beds"] . "' required><br>
                      <label for='room_capacity'>Room Capacity:</label>
                      <input type='text' name='room_capacity' value='" . $row["room_capacity"] . "' required><br>
                      <label for='room_amenities'>Room Amenities:</label>
                      <textarea name='room_amenities' required>" . $row["room_amenities"] . "</textarea><br>
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
        $room_id = $_POST["room_id"];
        $room_number = $_POST["room_number"];
        $room_name = $_POST["room_name"];
        $room_type = $_POST["room_type"];
        $room_price = $_POST["room_price"];
        $room_view = $_POST["room_view"];
        $room_beds = $_POST["room_beds"];
        $room_capacity = $_POST["room_capacity"];
        $room_amenities = $_POST["room_amenities"];

        // Cập nhật dữ liệu phòng vào bảng rooms
        $sql = "UPDATE rooms SET 
                room_number = '$room_number', 
                room_name = '$room_name', 
                room_type = '$room_type', 
                room_price = '$room_price', 
                room_view = '$room_view', 
                room_beds = '$room_beds', 
                room_capacity = '$room_capacity', 
                room_amenities = '$room_amenities' 
                WHERE room_id = $room_id";

        if ($conn->query($sql) === TRUE) {
            $message = "Cập nhật phòng thành công!";
            echo "<script>alert('$message');</script>";
            echo "<script>setTimeout(\"location.href = 'room-manage.php';\",500);</script>";
        } else {
            echo "Lỗi. " . $conn->error;
        }
    }

    $conn->close();
?> 