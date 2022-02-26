<?php 
include_once 'header.php';
?>

<section class="login.form">
    <div class="login-design-form">
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username/Email" />
            <input type="password" name="pwd" placeholder="Password" />
            <button type="submit" name="submit">Login</button>
        </form>
    </div>

    // ! Check a errors if a user write correct a data in the inputs
    <?php  
        if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
        
        } else if ($_GET["error"] == "wronglogin") {

        echo "<p>choose a proper username!</p>";
        } else if ($_GET["error"] == "invalidemail") {
        echo "<p>Incorrect login!</p>";
        }
    }
    ?>
</section>
<?php   
    include_once 'footer.php';
?>