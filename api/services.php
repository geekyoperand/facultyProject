<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "demo";
$id = '';

$con = mysqli_connect($host, $user, $password, $dbname);

$method = $_SERVER['REQUEST_METHOD'];

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}

switch ($method) {
  case 'GET':
    $id = $_GET['id'];
    $sql = "select * from faculty" . ($id ? " where id='$id'" : '');
    break;

  case 'PUT':
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $email = $data->useremail;
    $password = $data->userpassword;
    if (!preg_match("/^[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}$/", $email) || !preg_match("/^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/", $password)) {
      $json = '{
        "success": false,
        "status": 400,
        "error": "Please enter valid details!"
      }';
      echo json_encode($json);
      $con->close();
      exit();
    }
    $sql = "SELECT * FROM faculty WHERE email='$email' and password='$password'";
    break;

  case 'POST':
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $name = $data->name;
    $email = $data->email;
    $password = $data->password;
    if (!preg_match("/^[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}$/", $email) || !preg_match("/^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/", $password) || !preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $json = '{
        "success": false,
        "status": 400,
        "error": "Please enter valid details!"
      }';
      echo json_encode($json);
      $con->close();
      exit();
    }
    $sql = "SELECT * FROM faculty WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
      $json = '{
        "success": false,
        "status": 400,
        "error": "Email is already taken!"
      }';
      echo json_encode($json);
      $con->close();
      exit();
    }
    $sql = "INSERT INTO faculty (name, email, password) VALUES ('$name', '$email', '$password')";
    break;
}

// run SQL statement
$result = mysqli_query($con, $sql);

if (!$result) {
  http_response_code(404);
  die(mysqli_error($con));
} else {
  if ($method == 'PUT') {
    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
      $_SESSION["email"] = $row['email'];
    } else {
      $message = "Invalid email or Password!";
    }

    if (isset($_SESSION["email"])) {
      $json = '{
        "success": true,
        "status": 200,
        "error": false
      }';
      echo json_encode($json);
    } else {
      $json = '{
        "success": false,
        "status": 400,
        "error": "Invalid email or password!"
      }';
      echo json_encode($json);
    }
  } elseif ($method == 'POST') {
    $json = '{
        "success": true,
        "status": 200,
        "error": false
    }';
    echo json_encode($json);
  }
}

$con->close();
