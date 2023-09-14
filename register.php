<?php  

require_once 'includes/header.php';
//Array used for any possible errors
$errors = array('username'=>'','password'=>'');
$username = $password = $confPassword = "";

//Checking if the user has submitted anything
if ( isset($_POST['submit'])){
    //Check if the user has submitted a username
    if ( empty($_POST['username'])){
        $errors['username'] = "Username cannot be empty!";
    } else {
        $username = $_POST['username'];
        if ( !preg_match('/^[a-zA-Z0-9]+$/', $username)){
            $errors['username'] = "Alphanumeric characters only!";
        }
    }
}

?>

<div>
    <h1>Register</h1>
    <p>Already have an account? <a href="login.php">Log in!</a></p>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="redclass"><?php echo $errors['username']; ?></div>
        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username) ?>">
        <div class="redclass"><?php echo $errors['password']; ?></div>
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm password">
        <button type="submit" name="submit">REGISTER</button>
    </form>
</div>
<?php  
require_once 'includes/footer.php'
?>