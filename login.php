<?php
session_start();

$con = mysqli_connect('localhost', 'root' );

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Admin Login</title>
    <style>
        <?php include 'css/main.css'; ?>
    </style>
</head>
<body>
    <div class="main-box">
        <img src="pics/1.jpg" width="100%" height="200px">
        <div class="top-nav">
            <a href="index.php">Home</a>
        </div>
        
        <div class="inside-box1">
            <img src="pics/5.jpg" width="300" height="450" style="float:right">
            
            <form method="POST" action="logincheck.php">
             <div class="login-box">
                <div class="txtb"> 
                    <input type="text" name="username" placeholder="Enter Username">
                </div>
                <div class="txtb"> 
                    <input type="password" name="password" placeholder="Enter Password">
                </div>
                <input type="submit" class="loginbtn" value="LOGIN" name="submit">
             </div>
            </form>
            
        </div>
    </div>
</body>
</html>