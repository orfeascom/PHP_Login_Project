<?php  


?>

<div>
    <h1>Register</h1>
    <p>Already have an account? <a href="login.php">Log in!</a></p>

    <form action="includes/register-inc.php" method="post">
        <div class="redclass"><?php echo $errorUname; ?></div>
        <input type="text" name="username" placeholder="Username">
        <div class="redclass"><?php echo $errorPass; ?></div>
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm password">
        <button type="submit" name="submit">REGISTER</button>
    </form>
</div>
<?php  
require_once 'includes/footer.php'
?>