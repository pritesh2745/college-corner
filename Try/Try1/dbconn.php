<?php
$sever = "localhost";
$username = "root";
$password = "";
$database = "contacts";
$conn = mysqli_connect($sever,$username,$password,$database);
if (!$conn) {
    echo "Not done";
}
?>