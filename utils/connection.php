<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "demo";

$mysqli = new mysqli($host, $user, $password);
if ($mysqli === false) {
  // TODO - Handle error if we dont have proper credentials
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}

mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ALL);
try {
  $conn = mysqli_connect($host, $user, $password, $dbname);
} catch (mysqli_sql_exception $th) {
  header("Location: http://localhost/facultyProject/utils/createDb.php");
}
