<!-- To run page with session -->

<?php

session_start();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Page</title>
</head>
<!-- Data -->

<nav>
    <div>
        <ul>
            <?php 
                // ! Check if the user login
                if (isset($_SESSION["useruid"])) {
                    echo "<li><a href='profile.php'></a>Profile page</li>";
                    echo "<li><a href='includes/logout.inc.php'></a>Log in</li>";

                } else {
                    echo "<li><a href='signup.php'></a>Sign up</li>";
                    echo "<li><a href='login.php'></a>Log in</li>";
                }
            ?>
        </ul>
    </div>
</nav>

<body>