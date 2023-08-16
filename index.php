<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crowny Hotel</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>

<body>


  <header>
    <div class="content flex_space">
      <div class="logo">
        <img src="images/logo.png" alt="">
      </div>
      <div class="navlinks">
        <ul id="menulist">
          <li><a href="#home">home</a> </li>
          <li><a href="#about">about</a> </li>
          <li><a href="./rooms.php">rooms</a> </li>
          <li><a href="#pages">pages</a> </li>
          <li><a href="#news">news</a> </li>
          <li><a href="#contact">contact</a> </li>
          <li> <a href="./login.php">Admin</a> </li>
          <li> <button class="primary-btn">BOOK NOW</button> </li>
        </ul>
        <span class="fa fa-bars" onclick="menutoggle()"></span>
      </div>
    </div>
  </header>


  <script>
    var menulist = document.getElementById('menulist');
    menulist.style.maxHeight = "0px";

    function menutoggle() {
      if (menulist.style.maxHeight == "0px") {
        menulist.style.maxHeight = "100vh";
      } else {
        menulist.style.maxHeight = "0px";
      }
    }
  </script>


  <section class="home">
    <div class="content">
      <div class="owl-carousel owl-theme">
        <div class="item">
          <img src="images/banner-1.png" alt="">
          <div class="text">
            <h1>Spend Your Holiday</h1>
            <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
            </p>
            <div class="flex">
              <button class="primary-btn">READ MORE</button>
              <button class="secondary-btn">CONTACT US</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/banner-2.png" alt="">
          <div class="text">
            <h1>Spend Your Holiday</h1>
            <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
            </p>
            <div class="flex">
              <button class="primary-btn">READ MORE</button>
              <button class="secondary-btn">CONTACT US</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="images/banner-3.png" alt="">
          <div class="text">
            <h1>Spend Your Holiday</h1>
            <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
            </p>
            <div class="flex">
              <button class="primary-btn">READ MORE</button>
              <button class="secondary-btn">CONTACT US</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })
  </script>




  <section class="book">
    <div class="container flex_space">
      <div class="text">
        <h1> <span>Book </span> Your Rooms </h1>
      </div>
      <div class="search-form">
        <form class="grid" method="GET" action="search.php">
          <input type="date" placeholder="Check-in" min="today" name="checkin">
          <input type="date" placeholder="Check-out" name="checkout">
          <input type="number" placeholder="Guest" min="1" name="guests">
          <input type="submit" value="CHECK AVAILABILITY">
        </form>
      </div>
    </div>
  </section>
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


  <section class="about top">
    <div class="container flex">
      <div class="left">
        <div class="heading">
          <h1>WELCOME</h1>
          <h2>Crowny Hotel</h2>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
          aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
        <button class="primary-btn">ABOUT US</button>
      </div>
      <div class="right">
        <img src="images/about.png" alt="">
      </div>
    </div>
  </section>

  <section class="counter top" style="color:black">
    <div class="container grid">
      <div class="box">
        <h1>2500</h1>
        <hr>
        <span>Customer</span>
      </div>
      <div class="box">
        <h1>1250</h1>
        <hr>
        <span>Happy Customer</span>
      </div>
      <div class="box">
        <h1>150</h1>
        <hr>
        <span>Expert Technicians</span>
      </div>
      <div class="box">
        <h1>3550</h1>
        <hr>
        <span>Desktop Reaired</span>
      </div>
    </div>
  </section>


  <section class="rooms">
    <div class="container top">
      <div class="heading">
        <h1>EXPOLRE</h1>
        <h2>Our Rooms</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi cum totam eum.
        </p>
      </div>
      <style>
        .room-card {
          margin-bottom: 20px;
          display: flex;
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
        }

        .details:hover {
          color: white;
          background-color: #7fc142;
        }
      </style>
      <div class="content mtop">
        <div class="owl-carousel owl-carousel1 owl-theme">
          <?php
          $username = 'root';
          $password = '';
          $server = 'localhost';
          $dbname = 'hotel';

          $connect = new mysqli($server, $username, $password, $dbname);

          if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
          }

          $sql = "SELECT * FROM rooms WHERE room_booked = 0";

          $result = $connect->query($sql);

          while ($row = $result->fetch_assoc()) {
          ?>
            <!-- Room element start -->
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
                    <li><span>Price:&nbsp;</span><?= $row["room_price"]; ?> VNĐ/day</li>
                    <li><span>Capacity:&nbsp;</span><?= $row["room_capacity"]; ?> people</li>
                    <li><span>Amenities: </span><?= $row["room_amenities"]; ?></li>
                    <p></p>
                    <li>
                      <a id="<?= $row["room_id"] ?>" href="roomdetails.php?room_id=<?= $row["room_id"] ?>" class="details btn btn-sm btn-outline-success" >Room Details</a>
                </div>
              </div>
            </div>
          <?php
          }
          // Close connection
          $connect->close();
          ?>
        </div>
      </div>
  </section>
  <script>
    $('.owl-carousel1').owlCarousel({
      loop: true,
      margin: 40,
      nav: true,
      dots: false,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2,
        },
        1000: {
          items: 3
        }
      }
    })
  </script>
  </div>
  </section>

  <section class="gallery">
    <div class="container top">
      <div class="heading">
        <h1>PHOTOS</h1>
        <h2>Our Gallery</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti vitae amet commodi.
      </div>
    </div>

    <div class="content mtop">
      <div class="owl-carousel owl-carousel1 owl-theme">
        <div class="items">
          <div class="img">
            <img src="images/gallery-1.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-2.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-3.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-4.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-5.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-6.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-4.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-3.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-1.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="images/gallery-6.png" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div>
      </div>
    </div>
  </section>


  <script>
    $('.owl-carousel1').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 4,
        },
        1000: {
          items: 6
        }
      }
    })
  </script>


  <section class="services top">
    <div class="container">
      <div class="heading">
        <h1>SERVICES</h1>
        <h2>Our Services</h2>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam doloremque earum deserunt?
      </div>


      <div class="content flex_space">
        <div class="left grid2">
          <div class="box">
            <div class="text">
              <i class="fa-solid fa-champagne-glasses"></i>
              <h3>Delious Food</h3>
            </div>
          </div>
          <div class="box">
            <div class="text">
              <i class="fa-solid fa-person-biking"></i>
              <h3>Fintness</h3>
            </div>
          </div>
          <div class="box">
            <div class="text">
              <i class="fa-solid fa-utensils"></i>
              <h3>Inhouse Restaurant</h3>
            </div>
          </div>
          <div class="box">
            <div class="text">
              <i class="fa-solid fa-spa"></i>
              <h3>Beauty Spa</h3>
            </div>
          </div>
        </div>
        <div class="right">
          <img src="images/service.png" alt="">
        </div>
      </div>
    </div>
  </section>








  <section class="news top rooms">
    <div class="container">
      <div class="heading">
        <h1>NEWS</h1>
        <h2>Our News</h2>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis cum alias fuga.
      </div>


      <div class="content flex">
        <div class="left grid2">
          <div class="items">
            <div class="image">
              <img src="images/blog-1.png" alt="">
            </div>
            <div class="text">
              <h2>Lorem, ipsum dolor.</h2>
              <div class="admin flex">
                <i class="fa fa-user"></i>
                <label>Admin</label>
                <i class="fa fa-heart"></i>
                <label>500</label>
                <i class="fa fa-comments"></i>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
          <div class="items">
            <div class="image">
              <img src="images/blog-2.png" alt="">
            </div>
            <div class="text">
              <h2>Lorem, ipsum dolor.</h2>
              <div class="admin flex">
                <i class="fa fa-user"></i>
                <label>Admin</label>
                <i class="fa fa-heart"></i>
                <label>500</label>
                <i class="fa fa-comments"></i>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
        </div>

        <div class="right">
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s1.png" alt="">
            </div>
            <div class="stext">
              <h2>Lorem, ipsum dolor.</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s2.png" alt="">
            </div>
            <div class="stext">
              <h2>Lorem, ipsum dolor.</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s3.png" alt="">
            </div>
            <div class="stext">
              <h2>Lorem, ipsum dolor.</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="newsletter mtop">
    <div class="container flex_space">
      <h1>Subscribe to Our Hotel</h1>
      <input type="text" placeholder="Your Email">
      <input type="text" value="Subscribe">
    </div>
  </section>


  <footer>
    <div class="container grid">
      <div class="box">
        <img src="images/logo-2.png" alt="">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis doloribus optio dolore.</p>
        <div class="icon">
          <i class="fa fa-facebook-f"></i>
          <i class="fa fa-instagram"></i>
          <i class="fa fa-twitter"></i>
          <i class="fa fa-youtube"></i>
        </div>
      </div>

      <div class="box">
        <h2>Links</h2>
        <ul>
          <li>Company History</li>
          <li>About Us</li>
          <li>Contact Us</li>
          <li>Services</li>
          <li>Privacy Policy</li>
        </ul>
      </div>

      <div class="box">
        <h2>Contact Us</h2>
        <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
        </p>
        <i class="fa fa-location-dot"></i>
        <label>79 Hồ Tùng Mậu, Mai Dịch Cầu Giấy </label> <br>
        <i class="fa fa-phone"></i>
        <label>[+84]123456789</label> <br>
        <i class="fa fa-envelope"></i>
        <label>crownyhotel@gmail.com</label> <br>
      </div>
    </div>
  </footer>

  <div class="legal">
    <p class="container">Copyright (c) 2022 Copyright Holder All Rights Reserved.</p>
  </div>



  <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>
</body>