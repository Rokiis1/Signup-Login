<?php

// ! Signup input Error

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat){
    $result = '';
    // Check if there is data or empty
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
    $result =true;
    } else {
        $result =false;
    }
    return $result;
}
// ! If user_id is invalidate

function invalidUid($username){
    $result = '';
    // Serchin If parameters matched
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
    $result =true;
    } else {
        $result =false;
    }
    return $result;
}

// ! If email proper write

function invalidEmail($email){
    $result = '';
    // Check if this proper write email with php function FILTER_VALIDATE_EMAIL
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result =true;
    } else {
        $result =false;
    }
    return $result;
}

// ! If password match

function pwdMatch($pwd, $pwdRepeat){
    $result = '';
    // Check if password match with repeatpassword
    if ($pwd !== $pwdRepeat) {
    $result =true;
    } else {
        $result =false;
    }
    return $result;
}

// ! If failed to found in database

function uidExists($conn, $username, $email){
    // mark ? prevent from ejection to database
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $statment = mysqli_stmt_init($conn);
    // Check if there is a error
    if (!mysqli_stmt_prepare($statment, $sql)) {
        header("location: ../signup.php?error=statmentfailed");
        exit();
    }

    // ! if not failed that check

    mysqli_stmt_bind_param($statment, "ss", $username, $email);
    mysqli_stmt_execute($statment);


    $resultData = mysqli_stmt_get_result($statment);
    
    // Fetching a data
    // And creating second variable
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        
    } else{
        $result = false;
        return  $result;
    }

    mysqli_stmt_close($statment);
}

// ! Put your user data in database

function createUser($conn, $name, $email, $username, $pwd){
    // Put user data into data base using "INSERT" 
    $sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?);";
    $statment = mysqli_stmt_init($conn);
    // Check if there is a error
    if (!mysqli_stmt_prepare($statment, $sql)) {
        header("location: ../signup.php?error=statmentfailed");
        exit();
    }

    // ! to make that your password be safe

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


     // ! if not failed that check

    mysqli_stmt_bind_param($statment, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($statment);
    mysqli_stmt_close($statment);
    header("location: ../signup.php?error=none");
    exit();
 
}

// !!!! Login function

// Signup input Error

function emptyInputLogin($username, $pwd){
    $result = '';
    // Check if there is data or empty
    if (empty($username) || empty($pwd)) {
    $result =true;
    } else {
        $result =false;
    }
    return $result;
}

function loginUser($conn, $username, $pwd) {
    // That you can take ether username or email so I use both $usernames
    // in 58 line i write a code where I use or so Email or username
    $uidExists = uidExists($conn, $username, $username);
    // ! Error handler
    if ($uidExists === false) {
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    // Check password if there in database
    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);
    // Checking password if the same from DB and user
    if ($checkPwd === false) {
        header("location: ../login.php?error=wronglogin");

    } else if ($checkPwd === true) {
        //  to take data from site
        session_start();
        $_SESSION["userid"] = $uidExists["usersId"];
        $_SESSION["useruid"] = $uidExists["usersUId"];
        header("location: ../index.php");
        exit();
    }

}