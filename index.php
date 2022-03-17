<?php
require_once "/xampp/htdocs/facultyProject/utils/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>LKCTC Faculty</title>

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- Font Awesome Icons-->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>
  <div id="root"></div>

  <!-- App.js -->
  <script type="text/babel" src="./App.js"></script>
  <!-- Router -->
  <script type="text/babel" src="./Router.js"></script>

  <!-- Screens -->
  <!-- Layout Page -->
  <script type="text/babel" src="./src/pages/layout/Layout.js"></script>
  <!-- Login Signup Form Page -->
  <script type="text/babel" src="./src/pages/Signup/LoginSignupForm.js"></script>
  <!-- Login Page -->
  <script type="text/babel" src="./src/pages/Signup/Login.js"></script>
  <!-- Signup Page -->
  <script type="text/babel" src="./src/pages/Signup/Signup.js"></script>
  <!-- Classes Screen -->
  <script type="text/babel" src="./src/pages/Classes/Classes.js"></script>

  <!-- Components -->
  <script type="text/babel" src="./src/components/Toast.js"></script>

  <!-- Css -->
  <!-- Toastify Css -->
  <link rel="stylesheet" type="text/css" href="./lib/toastify/index.css">
  <!-- Antd Css -->
  <link rel="stylesheet" type="text/css" href="./lib/antd/index.css" />
  <!-- Own Css -->
  <link rel="stylesheet" href="./index.scss">
  <link rel="stylesheet" href="./src/pages/Signup/index.scss">

  <!-- Main Script -->
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