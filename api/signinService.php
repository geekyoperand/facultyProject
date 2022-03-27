<?php

require_once "/xampp/htdocs/facultyProject/utils/connection.php";
$method = $_SERVER['REQUEST_METHOD'];

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

switch ($method) {
  case 'POST':
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    $name = $data->name;
    $email = $data->email;
    $password = $data->password;
    if (!preg_match("/^[a-zA-Z0-9.-_]{1,}@[a-zA-Z.-]{2,}[.]{1}[a-zA-Z]{2,}$/", $email) || !preg_match("/^(?=.*[0-9])[a-zA-Z0-9!@#$%^&*]{6,16}$/", $password) || !preg_match("/^[a-zA-Z-' ]*$/", $name)) {
      $json =  ["success" => false, "status" => 400, "error" => "Please enter valid details!"];
      echo json_encode($json);
      $conn->close();
      exit();
    }
    $sql = "SELECT * FROM faculty WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    if (is_array($row)) {
      $json =  ["success" => false, "status" => 400, "error" => "Email is already taken!"];
      echo json_encode($json);
      $conn->close();
      exit();
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO faculty (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";
    break;
}

// run SQL statement
$result = mysqli_query($conn, $sql);

if (!$result) {
  http_response_code(404);
  die(mysqli_error($conn));
} else {
  if ($method == 'POST') {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode(['email' => $email, 'password' => $password, 'name' => $name]);
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'Test@123', true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

    $json = ["success" => true, "status" => 200, "error" => false, "token" => $jwt];
    echo json_encode($json);
  }
}

$conn->close();
