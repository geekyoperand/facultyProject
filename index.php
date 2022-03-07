<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "demo";

$mysqli = new mysqli($host, $user, $password, $dbname);
if ($mysqli->connect_errno) {
  header("Location: http://localhost/facultyProject/createDb.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>LKCTC Faculty</title>

  <!-- Toastify Css -->
  <link rel="stylesheet" type="text/css" href="./lib/toastify/index.css">
  <!-- Antd Css -->
  <link rel="stylesheet" type="text/css" href="./lib/antd/index.css" />

</head>

<body>
  <div id="root"></div>

  <!-- App.js -->
  <script type="text/babel" src="./App.js"></script>
  <!-- Router -->
  <script type="text/babel" src="./Router.js"></script>

  <!-- Screens -->
  <!-- Login Signup Form Page -->
  <script type="text/babel" src="./src/pages/LoginSignupForm.js"></script>
  <!-- Login Page -->
  <script type="text/babel" src="./src/pages/Login.js"></script>
  <!-- Signup Page -->
  <script type="text/babel" src="./src/pages/Signup.js"></script>

  <!-- Components -->
  <script type="text/babel" src="./src/components/Toast.js"></script>

  <!-- Css -->
  <link rel="stylesheet" href="./index.scss">
  <link rel="stylesheet" href="./src/pages/index.scss">
  <script type="text/babel">ReactDOM.render(<App />, document.getElementById("root"));</script>

  <!-- CDN's JS -->
  <!-- React -->
  <script src="./lib/react/react.js"></script>
  <script src="./lib/react/react-dom.js"></script>
  <!-- Load Babel Compiler -->
  <script src="./lib/babel/index.js"></script>
  <!-- Axios -->
  <script src="./lib/axios/index.js"></script>
  <!-- Antd Js -->
  <script src="./lib/antd/index.js"></script>
  <script src="./lib/antd/moment.js"></script>
  <!-- Toastify Js -->
  <script type="text/javascript" src="./lib/toastify/index.js"></script>

</body>

</html>