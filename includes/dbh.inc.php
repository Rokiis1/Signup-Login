<?php
// ! connect database

// $serverName = "localHost";
// $dBUsername = "root";
// $dBPassword = "";
// $dBName = "login";

// Connection
$conn = mysqli_connect("localHost", "root", "", "login");

if (!$conn) {
    // Kill
    die("Connection failed:" . mysqli_connect_error());

}