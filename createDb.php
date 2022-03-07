<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "demo";

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$mysqli = new mysqli($host, $user, $password);

// Check connection
if ($mysqli === false) {
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// Attempt create database query execution
try {
  $sql = "CREATE DATABASE demo";
  if ($mysqli->query($sql) === true) {
    echo "Database created successfully";
  } else {
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
  }
} catch (\Throwable $th) {
  echo "Error in creating Database :-" . $th;
}


$mysqli = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($mysqli === false) {
  die("ERROR: Could not connect. " . $mysqli->connect_error);
}

// Attempt create table query execution
$sql = "CREATE TABLE faculty(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(20) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

try {
  if ($mysqli->query($sql) === true) {
    echo "Table created successfully.";
  } else {
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
  }
} catch (\Throwable $th) {
  echo "Error in creating table :- " . $th;
}

// Close connection
$mysqli->close();
header("Location: http://localhost/facultyProject/");

