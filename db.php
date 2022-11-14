<?php

$host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "studentlife";

$connection = new mysqli($host, $db_user, $db_password, $db_name);

if ($connection->connect_error) {
	die("Connection failed: " . $connection->connect_error);
}
