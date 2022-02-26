<?php
// ! Checking if is everthing okay that user can login
if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
     $pwd = $_POST["pwd"];

    // Get information from includes
     require_once 'dbh.inc.php';
     require_once 'functions.inc.php';

     // To check if writted everything in the inputs
if (emptyInputLogin($username, $pwd) !== false) {
    header("location: ../login.php?error=emptyinput");
    // exit entire
    exit();
}
// connect to data base
loginUser($conn, $username, $pwd);

} else {
    header("location: ../login.php");
    exit();
}