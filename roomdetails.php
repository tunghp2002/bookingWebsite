<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Room Details</title>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

  <style>
    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .room-image {
      max-width: 100%;
      height: auto;
    }

    .room-details {
      margin-top: 20px;
    }

    .room-details h2 {
      margin-bottom: 10px;
    }

    .room-details p {
      margin-bottom: 10px;
    }




    #modal-body {
      display: none;
    }

    #modal-body.show {
      display: block;
    }

    .modal-footer {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    #result {
      color: red;
      margin-top: 20px;
      font-weight: bold;

    }

    form {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      width: 300px;
      border-radius: 8px;
    }


    .form-group {
      margin: 10px 0;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      width: 100%;
    }


    label {
      font-weight: bold;
    }


    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    input[type="number"] {
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      width: 100%;
    }


    button {
      margin-top: 10px;
      color: #7fc142;
      border: solid 1px;
      padding: 10px;
      right: 0px;
      bottom: 0px;
      border-radius: 8px;
    }

    button:hover {
      color: white;
      background-color: #7fc142;
    }

    .btn-cancel {
      margin-top: 10px;
      color: lightcoral;
      border: solid 1px;
      padding: 10px;
      right: 0px;
      bottom: 0px;
      border-radius: 8px;
      width: 40%;
    }

    .btn-cancel:hover {
      color: white;
      background-color: lightcoral;
    }

    .btn-next {
      margin-top: 10px;
      color: #7fc142;
      border: solid 1px;
      padding: 10px;
      right: 0px;
      bottom: 0px;
      border-radius: 8px;
      width: 40%;
    }


    .btn-return {
      margin-top: 10px;
      color: lightcoral;
      border: solid 1px;
      padding: 10px;
      right: 0px;
      bottom: 0px;
      border-radius: 8px;
      width: 40%;
    }

    .btn-return:hover {
      color: white;
      background-color: lightcoral;
    }

    .btn-confirm {
      margin-top: 10px;
      color: #7fc142;
      border: solid 1px;
      padding: 10px;
      right: 0px;
      bottom: 0px;
      border-radius: 8px;
      width: 40%;
      cursor: pointer;
    }

    .btn-confirm:hover {
      color: white;
      background-color: #7fc142;
    }

    .confirm-body {
      line-height: 30px;
      padding: 10px;
    }

    .confirm-footer {
      display: flex;
      gap: 10px;
      justify-content: center;
    }

    .confirm-body {
      font-weight: normal;
    }

    .btn-booking {
      width: 15x0px;
      font-size: 20px;
    }
  </style>

</head>


<body style="background-color: rgba( 245, 245, 220, 1 )">
  <header style="background-color: white;">
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
  <div class="container">
    <?php
    $room_id = $_GET['room_id'];
    $username = 'root';
    $password = '';
    $server = 'localhost';
    $dbname = 'hotel';

    $connect = new mysqli($server, $username, $password, $dbname);

    if ($connect->connect_error) {
      die("Connection failed: " . $connect->connect_error);
    }

    $sql = "SELECT * FROM rooms WHERE room_id=$room_id";

    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
    ?>
      <div class="room-image" style="display:flex">
        <img style="width: 70%;" src="<?= 'uploads/' . $row["room_image"] ?>" alt="Room Image">
        <div class="booking-button" style="padding-top: 200px; padding-left:20px">
          <h2 style="margin-bottom:20px; margin-left:30px"><?= ucfirst($row["room_name"]) ?></h2>
          <button type="button" class="btn btn-booking" onclick="book()" style="width:200px">Book now</button>
        </div>
      </div>
      <div class="room-details">
        <b>Script</b>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste, eius ut, odio harum corrupti, deserunt esse dolore ex quaerat neque facilis non dolorum at repudiandae. Possimus distinctio quia repellat totam?</p>
        <p><b>Room Type:</b> <?= $row["room_type"] ?></p>
        <p><b>View:</b> <?= $row["room_view"] ?></p>
        <p><b>Price:</b> <?= $row["room_price"] ?> VNĐ/day</p>
        <p><b>Capacity:</b> <?= $row["room_capacity"] ?> people</p>
        <p><b>Amenities:</b> <?= $row["room_amenities"] ?></p>
        <p><b>Beds:</b> <?= $row["room_beds"] ?></p>
        <p><b>Detail:</b></p>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum minima, laborum unde quasi earum eligendi fugiat eaque libero placeat facilis commodi vero laboriosam et voluptate vitae est ab neque? Impedit minima accusamus quia fugiat saepe non facere unde cupiditate veritatis nulla optio obcaecati dolore, alias aspernatur qui. Assumenda magnam commodi ea, neque culpa, mollitia corrupti placeat nesciunt molestias officiis optio rerum dolorem tempora magni accusamus perspiciatis? Rem excepturi a cumque! Expedita doloribus corrupti asperiores ipsa facilis, culpa rerum cumque esse accusamus dignissimos? Repellendus excepturi dolor assumenda fuga reprehenderit doloribus recusandae minus esse amet aliquid voluptates, voluptatem quisquam laboriosam mollitia sapiente commodi maxime numquam quibusdam repudiandae corrupti necessitatibus ea. Est, repellat fugiat. Dolor numquam ratione repellat expedita laboriosam modi fugiat, iusto at ad officiis explicabo voluptatum ex voluptatem, quasi est mollitia, quidem similique quis quae aut ipsa magnam nesciunt in. Recusandae ducimus ipsum labore excepturi sequi optio animi, natus reiciendis nisi.</p>
      </div>
    <?php
    } else {
      echo "Room not found.";
    }
    $connect->close();
    ?>
  </div>

  <!-- Booking Form -->

  <form action="process-booking.php" method="POST">
    <div class="modal-body" id="modal-body">
      <div class="form-group">
        <label for="name">Full name:</label>
        <input type="text" class="form-control" id="name" name="name" require>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" require>
      </div>
      <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="tel" class="form-control" id="phone" name="phone" require>
      </div>
      <div class="form-group">
        <label for="checkin">Check-in:</label>
        <input type="date" class="form-control" id="checkin" name="checkin" require>
      </div>
      <div class="form-group">
        <label for="checkout">Check-out:</label>
        <input type="date" class="form-control" id="checkout" name="checkout" require>
      </div>
      <div id="result" class="result"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancel" onclick="cancel()">Cancel</button>
        <button type="button" class="btn btn-next" onclick="confirmBooking()">Next</button>
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
    <div class="confirm-body" id="confirm-booking" style="display:none;">
      <h3 style="margin-bottom:10px;">Confirm booking form:</h3>
      <input type="hidden" name="roomId" value="<?= $row["room_id"] ?>">
      <div><b>Full Name:</b> <span id="customer-name"></span> </div>
      <div><b>Type:</b> <?= $row["room_type"] ?></div>
      <div><b>Price:</b> <?= $row["room_price"] ?> VNĐ/day</div>
      <div><b>Check-in:</b>
        <p id="check-in-date"></p>
      </div>
      <div><b>Check-out:</b>
        <p id="check-out-date"></p>
      </div>
      <div><b>Total: </b><span id="total-price"></span></div>
      <div class="confirm-footer">
        <button type="button" class="btn btn-return" onclick="Return()">Return</button>
        <input type="submit" class="btn btn-confirm" value="Confirm"></input>
      </div>
    </div>
  </form>

  <script>
    const bookBtn = document.getElementById('btn-booking');
    const modalBody = document.getElementById('modal-body');
    const confirmBody = document.getElementById('confirm-booking');

    function book() {
      modalBody.classList.add('show');
      document.body.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
    }

    function cancel() {
      modalBody.classList.remove('show');
      document.body.style.backgroundColor = 'rgba( 245, 245, 220, 1 )';
    }

    function confirmBooking() {

      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const phone = document.getElementById("phone").value;
      const checkin = document.getElementById("checkin").value;
      const checkout = document.getElementById("checkout").value;
      const result = document.getElementById("result");
      const roomPrice = <?= $row["room_price"] ?>;

      if (!name || !email || !phone || !checkin || !checkout ) {
        result.innerHTML = `<p>Invalid input! Try again!`;
        return false;
      }


      const startDate = new Date(checkin);
      const endDate = new Date(checkout);
      const currentTime = new Date();
      const minDate = new Date(currentTime.getFullYear(), currentTime.getMonth(), currentTime.getDate())
      const totalDays = (endDate.getTime() - startDate.getTime()) / (1000 * 60 * 60 * 24);
      const totalPrice = totalDays * roomPrice;



      document.getElementById("customer-name").textContent = name;
      document.getElementById("check-in-date").textContent = checkin;
      document.getElementById("check-out-date").textContent = checkout;
      document.getElementById("total-price").textContent = totalPrice.toLocaleString() + `.000 VNĐ`;


      document.getElementById("confirm-booking").style.display = "block";
      modalBody.classList.remove('show');
    }

    function Return() {
      document.getElementById("confirm-booking").style.display = "none";
      modalBody.classList.add('show');
    }
  </script>
</body>

</html>