<?php 
require_once 'includes/database.php'; 
session_start();
$user = "";
if (isset($_SESSION['sessionUser'])){
    $user = $_SESSION['sessionUser'];
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <li class="user"><?php if ($user != "")echo "Hello, $user"?></li>
        </ul>
    </nav>
</header>