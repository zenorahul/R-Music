<?php
session_start();

$con = mysqli_connect('localhost', 'root' );
if($con){
    echo "Connection successful";
}
else{
    echo "Connection un-successful";
}

$db = mysqli_select_db($con, 'rmusic');

if(isset($_POST['submit'])){
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    
    $sql = "select * from admindb where username = '$uname' and password = '$pass'";
    
    $query = mysqli_query($con,$sql);
    
    $row = mysqli_num_rows($query);
        if($row == 1){
            echo "Login successful";
            $_SESSION['username'] = $uname;
            header('location:adminpage.php');
        }
        else{
            echo "login failed";
            header('location:login.php');
        }
}

?>