<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>

<style>
    .custom-room-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 50px;
        margin-top: 20px;
    }

    .room-card {
        margin-bottom: 20px;
        display: flex;
        width: 30%;
        border: 1px solid black;
        border-radius: 8px;
        padding: 10px;
        position: relative;
    }

    .card {
        border: none;
    }

    .card-body {
        padding: 0;
    }

    .card-footer {
        background-color: #f7f7f7;
        padding: 10px 15px;
        text-align: center;
        font-size: 20px;
    }

    .footer-body {
        font-weight: bold;
    }

    .list-group li {
        padding: 7px 0;
    }

    .details {
        margin-top: 10px;
        color: #7fc142;
        border: solid 1px;
        padding: 10px;
        position: absolute;
        right: 0px;
        bottom: 0px;
        border-radius: 8px;
    }

    .details:hover {
        color: white;
        background-color: #7fc142;
    }
</style>

<body>
    <header>
        <div class="content flex_space">
            <div class="logo">
                <img src="images/logo.png" alt="">
            </div>
            <div class="navlinks">
                <ul id="menulist">
                    <li><a href="./index.php">home</a> </li>
                    <li><a href="#about">about</a> </li>
                    <li><a href="#rooms">rooms</a> </li>
                    <li><a href="#pages">pages</a> </li>
                    <li><a href="#news">news</a> </li>
                    <li><a href="#contact">contact</a> </li>
                    <li> <i class="fa fa-search"></i> </li>
                    <li> <button class="primary-btn">BOOK NOW</button> </li>
                </ul>
                <span class="fa fa-bars" onclick="menutoggle()"></span>
            </div>
        </div>
    </header>
    <section class="book">
        <div class="container flex_space">
            <div class="text">
                <h1> <span>Book </span> Your Rooms </h1>
            </div>
            <div class="search-form">
                <form class="grid" method="GET" action="search.php">
                    <input type="date" placeholder="Check-in" name="checkin">
                    <input type="date" placeholder="Check-out" name="checkout">
                    <input type="number" placeholder="Guest" min="1" name="guests">
                    <input type="submit" value="CHECK AVAILABILITY">
                </form>
            </div>
        </div>
    </section>
    <div class="container my-5">
        <div class="section-title" style="margin-top:20px" ;>
            <h2>Rooms</h2>
        </div>
        <div class="row custom-room-cards">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "hotel";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $checkin = $_GET['checkin'];
            $checkout = $_GET['checkout'];
            $guests = $_GET['guests'];

            $query = "SELECT * FROM rooms WHERE room_capacity >= $guests 
          AND room_id NOT IN (SELECT room_id FROM bookings
                              WHERE (check_in_date <= '$checkout' AND check_out_date >= '$checkin'))";

            $result = mysqli_query($conn, $query);
            if (!$result) {
                header("Location: rooms.php");
            }
            // Hiển thị kết quả tìm kiếm
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <!--Hiển thị thông tin về các phòng trống-->
                    <div class="room-card col-md-6">
                        <div class="card card-expanded">
                            <div class="basic">
                                <div class="card-body">
                                    <img style="width:100%" src="<?= 'uploads/' . $row["room_image"] ?>" />
                                </div>
                                <div class="card-footer">
                                    <div class="footer-body"><?= ucfirst($row["room_name"]); ?></div>
                                </div>
                            </div>
                            <div class="detail">
                                <ul class="list-group list-unstyled">
                                    <li><span>View:&nbsp;</span><?= $row["room_view"]; ?></li>
                                    <li><span>Giá:&nbsp;</span><?= $row["room_price"]; ?> VNĐ/ ngày</li>
                                    <li><span>Phòng chứa:&nbsp;</span><?= $row["room_capacity"]; ?>/người</li>
                                    <li><span>Tiện nghi: </span><?= $row["room_amenities"]; ?></li>
                                    <p></p>
                                    <li>
                                        <a id="<?= $row["room_id"] ?>" href="roomdetails.php?room_id=<?= $row["room_id"] ?>" class="details btn btn-sm btn-outline-success">Room Details</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "Không tìm thấy phòng trống phù hợp.";
            }
            mysqli_close($conn);
            ?>
        </div>

    </div>
    <script>
        let tomorrow = new Date();
        tomorrow.setDate(new Date().getDate() + 1);
        let tomorrowString = tomorrow.toISOString().substr(0, 10);

        document.querySelector('input[name="checkin"]').setAttribute("min", tomorrowString);
        document.querySelector('input[name="checkout"]').setAttribute("min", tomorrowString);

        document.querySelector('input[name="checkin"]').addEventListener("change", function() {
            let checkinDate = new Date(this.value);
            let checkoutDate = new Date(checkinDate.getTime() + (24 * 60 * 60 * 1000)); // add 1 day
            let checkoutString = checkoutDate.toISOString().substr(0, 10);
            document.querySelector('input[name="checkout"]').setAttribute("min", checkoutString);
        });
    </script>
</body>

</html>