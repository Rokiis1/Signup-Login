<?php 
// Checking if is everthing okay that user apply correct
if (isset($_POST["submit"])) {
    
$name = $_POST["name"];
$email = $_POST["email"];
$username = $_POST["uid"];
$pwd = $_POST["pwd"];
$pwdRepeat = $_POST["pwdrepeat"];

// If singed correctly and if me make mistakes to found a error if not that's pass
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

// To check if writted everything in the inputs
if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=emptyinput");
    // exit entire
    exit();
}
// Check Uid
if (invalidUid($username) !== false) {
    header("location: ../signup.php?error=invaliduid");
    exit();
}
// Check Email
if (invalidEmail($email) !== false) {
    header("location: ../signup.php?error=invalidemail");
    exit();
}
// Check if passwords not the same
if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
}
// Crossing because there is another 
if (uidExists($conn, $username, $email) !== false) {
    header("location: ../signup.php?error=usernametaken");
    exit();
}

// Get user info to database to save
createUser($conn, $name, $email, $username, $pwd);

} 
else {
    header("location: ../signup.php");
    exit();
};

?>