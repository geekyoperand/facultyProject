<?php

require "/xampp/htdocs/facultyProject/utils/connection.php";
$method = $_SERVER['REQUEST_METHOD'];

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

switch ($method) {
  case 'GET':
    $json = $_SERVER['HTTP_TOKENID'];
    $data = json_decode(base64_decode(str_replace('_', '/', str_replace('-', '+', explode('.', $json)[1]))));
    if (!(isset($data->email) && isset($data->password))) {
      $json = ["success" => false, "status" => 400, "error" => "Invalid Token!"];
      echo json_encode($json);
      $conn->close();
      exit();
    }
    $email = $data->email;
    $password = $data->password;
    if (!preg_match("/^[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}$/", $email) || !preg_match("/^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/", $password)) {
      $json = ["success" => false, "status" => 400, "error" => "Please enter valid details!"];
      echo json_encode($json);
      $conn->close();
      exit();
    }
    $sql = "SELECT * FROM faculty WHERE email='$email'";
    break;
}

// run SQL statement
$result = mysqli_query($conn, $sql);

if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
} else {
  if ($method == 'GET') {
    $row = mysqli_fetch_array($result);
    if (password_verify($password, $row['password'])) {
      $userData = ['name' => $row['name'], 'email' => $row['email']];
      $json = ["success" => true, "data" => $userData, "status" => 200, "error" => false];
      echo json_encode($json);
    } else {
      $json = ["success" => false, "status" => 400, "error" => "Invalid email or password!"];
      echo json_encode($json);
    }
  }
}

$conn->close();
