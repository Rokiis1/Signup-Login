<?php

// ! Destroy all session inside in current session to logout

session_start();
session_unset();
session_destroy();
// Where is the user send
header("location: ../index.php");
exit();