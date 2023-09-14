<?php  

require_once 'includes/header.php';
//Array used for any possible errors
$errors = array('username'=>'','password'=>'','dbErrors'=>'leto');
$username = $password = $confPassword = "";

//Checking if the user has submitted anything
if ( isset($_POST['submit'])){

    //Check if the user has submitted a username
    if ( empty($_POST['username'])){
        $errors['username'] = "Username cannot be empty!";
    } else {
        $username = $_POST['username'];
        //Check if the user provided a valid username
        if ( !preg_match('/^[a-zA-Z0-9]+$/', $username)){
            $errors['username'] = "Alphanumeric characters only!";
        }
    }

    //Check if the user has sabmitted a password/conf password
    if ( empty($_POST['password'])){
        $errors['password'] = "A password must be provided!";
    } else {
        if ( empty($_POST['confirmPassword'])){
            $errors['password'] = "Please confirm your password!";
        } else {
            $password = $_POST['password'];
            $confPassword = $_POST['confirmPassword'];
            if ( !preg_match('/^[a-zA-Z0-9]+$/', $password)){
                $errors['password'] = "Please enter a valid password!";                
            } else {
                if ( $password === $confPassword){
                    header('Location: index.php');
                } else {
                    $errors['password'] = "Password and Confirm password must match!";
                }
            }
        }
    }
}

?>
<div class="errorClass"><?php echo $errors['dbErrors']; ?></div>
<div>
    <h1>Register</h1>
    <p>Already have an account? <a href="login.php">Log in!</a></p>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="redClass"><?php echo $errors['username']; ?></div>
        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username) ?>">
        <div class="redClass"><?php echo $errors['password']; ?></div>
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm password">
        <button type="submit" name="submit">REGISTER</button>
    </form>
</div>
<?php  
require_once 'includes/footer.php'
?>