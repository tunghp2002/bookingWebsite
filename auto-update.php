
 <?php
    function updateRoomStatus()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "hotel";
        // Tạo kết nối
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Lấy danh sách các phòng đã check-out trước đó nhưng chưa được cập nhật
        $sql = "SELECT * FROM rooms";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                // Kiểm tra nếu không có dữ liệu từ bảng bookings với room_id tương ứng
                $booking_sql = "SELECT MIN(check_in_date) AS min_check_in_date, MIN(check_out_date) AS min_check_out_date FROM bookings WHERE room_id = " . $row["room_id"];
                $booking_result = $conn->query($booking_sql);
                $booking_row = $booking_result->fetch_assoc();
                if ($booking_result->num_rows == 0 || $booking_row["min_check_out_date"] < $row["check_out_date"]) {
                } else {
                    // Có dữ liệu trong bảng bookings
                    $sql_update = "UPDATE rooms SET room_booked = 1, check_in_date = '" . $booking_row["min_check_in_date"] . "', check_out_date = '" . $booking_row["min_check_out_date"] . "' WHERE room_id = " . $row["room_id"];
                }
                if (($row["check_in_date"] != $booking_row["min_check_in_date"]) || ($row["check_out_date"] != $booking_row["min_check_out_date"])) {
                    $sql_update = "UPDATE rooms SET room_booked = 1, check_in_date = '" . $booking_row["min_check_in_date"] . "', check_out_date = '" . $booking_row["min_check_out_date"] . "' WHERE room_id = " . $row["room_id"];
                }   

                if ($conn->query($sql_update) === TRUE) {
                    // Cập nhật thành công
                } else {
                    // Cập nhật thất bại
                    $conn->error;
                }
                $sql_check = "SELECT * FROM bookings WHERE room_id = " . $row["room_id"] . " AND check_out_date > CURDATE()";
                $result_check = $conn->query($sql_check);
                if ($result_check->num_rows == 0) {
                    // Không có bản ghi nào được tìm thấy, có thể cập nhật trạng thái phòng
                    $sql_update = "UPDATE rooms SET room_booked = 0, check_in_date = null, check_out_date = null WHERE room_id = " . $row["room_id"];
                    if ($conn->query($sql_update) === TRUE) {
                        // Cập nhật thành công
                    } else {
                        // Cập nhật thất bại
                        $conn->error;
                    }
                }
            }
        }

        // Đóng kết nối tới database
        $conn->close();
    }
    ?>