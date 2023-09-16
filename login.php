<?php  
require_once 'includes/header.php';
$errors = array('username'=>'','password'=>'', 'dbErrors'=>'');
$username = $password = "";
if (isset($_POST['submit'])){
    require_once 'includes/database.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        $errors['username'] = "You must provide a username...";
    } else {
        if(empty($password)){
            $errors['password'] = "You must provide a password...";
        } else {
            $sql ="SELECT * FROM users WHERE username = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                $errors['dbErrors'] = "Could not execute the query...";
            } else {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)){
                    $passCheck = password_verify($password, $row['password']);
                    if ($passCheck){
                        session_start();
                        $_SESSION['sessionId'] = $row['id'];
                        $_SESSION['sessionUser'] = $row['username'];
                        header("Location: index.php");
                        exit();
                    } else {
                        $errors['username'] = "Wrong login credentials...";
                    }
                } else {
                    $errors['username'] = "Wrong login credentials...";
                }
            }
        }
    }
}

?>
<div class="errorClass"><?php echo $errors['dbErrors']; ?></div>
<div>
    <h1>Log in</h1>
    <p>No account? <a href="register.php">Register here!</a></p>

    <form action="login.php" method="post">
        <div class="redClass"><?php echo $errors['username'];?></div>
        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username)?>">
        <div class="redClass"><?php echo $errors['password'];?></div>
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="submit">LOGIN</button>
    </form>
</div>
<?php  
require_once 'includes/footer.php'
?>