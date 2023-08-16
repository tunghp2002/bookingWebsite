<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    #login-box {
      width: 400px;
      background-color: #fff;
      border-radius: 5px;
      padding: 20px;
      margin: 100px auto;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    }

    h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 10px;
      margin-bottom: 20px;
      border: solid 0.2px;
      border-radius: 3px;
      box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
      margin-top: 10px;
      font-size: 20px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 3px;
      padding: 10px;
      cursor: pointer;
      font-size: 20px;
    }

    input[type="submit"]:hover {
      background-color: #3e8e41;
    }

    label {
      font-size: 20px;
    }
  </style>
</head>

<body>
  <div id="login-box">
    <h2>Đăng nhập</h2>
    <form method="post" action="">
      <label for="username">Tên đăng nhập:</label><br />
      <input type="text" id="username" name="username" /><br />
      <label for="password">Mật khẩu:</label><br />
      <input type="password" id="password" name="password" /><br />
      <input type="submit" value="Đăng nhập" />
    </form>
  </div>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "hotel";
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
  }
  session_start();
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
      $_SESSION['login_user'] = $username;
      $message = "Đăng nhập thành công!";
      echo "<script>alert('$message');</script>";
      echo "<script>setTimeout(\"location.href = 'room-manage.php';\",500);</script>";
    } else {
      $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
      echo "<script>alert('$error');</script>";
    }
  }
  ?>
</body>

</html