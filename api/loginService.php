<?php

require "/xampp/htdocs/facultyProject/utils/connection.php";
$method = $_SERVER['REQUEST_METHOD'];

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

switch ($method) {
  case 'POST':
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
      $conn->close();
      exit();
    }
    $sql = "SELECT `password` FROM faculty WHERE email='$email'";
    break;
}

// run SQL statement
$result = mysqli_query($conn, $sql);

if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
} else {
  if ($method == 'POST') {
    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
      if (password_verify($password, $row['password'])) {
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
    }
  }
}

$conn->close();
