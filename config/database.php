<?php

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'feedback_db');

//Create our connection
$conn = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

//Check the connection
if ($conn->connect_error) {
    die('Connection Failed!' . $conn->connect_error);
}