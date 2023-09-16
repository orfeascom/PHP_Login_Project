<?php  

require_once 'includes/header.php';
require_once 'includes/database.php';
//Array used for any possible errors
$errors = array('username'=>'','password'=>'','dbErrors'=>'');
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

    //Check if the user has submitted a password/conf password
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
                    $sql = "SELECT username FROM users WHERE username = ?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt,$sql)){
                        header("Location: register.php");
                        $errors['dbErrors'] = "Could not execute the query...";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $rowCount = mysqli_stmt_num_rows($stmt);

                        if ($rowCount > 0){
                            $errors['username'] = "Username already exists...";
                        } else {
                            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt,$sql)){
                                header("Location: register.php");
                                $errors['dbErrors'] = "Could not execute the query...";
                                exit();
                            } else {
                                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                                mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPass);
                                mysqli_stmt_execute($stmt);
                                header("Location: index.php");
                                exit();
                            }
                        }
                    }
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
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
        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username)?>">
        <div class="redClass"><?php echo $errors['password']; ?></div>
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirmPassword" placeholder="Confirm password">
        <button type="submit" name="submit">REGISTER</button>
    </form>
</div>
<?php  
require_once 'includes/footer.php'
?>