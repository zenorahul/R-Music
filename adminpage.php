<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Admin Home</title>
    <style>
        <?php include 'css/main.css'; ?>
        <?php include 'css/alert.css'; ?>
    </style>
</head>
<body>
    <div class="main-box">
        <img src="pics/1.jpg" width="100%" height="200px">
        <div class="top-nav">
            <a href="logout.php">Logout</a> 
        </div>
        
        <div class="inside-box">
            <center><h1>Welcome back, <?php echo $_SESSION['username'] ?>!</h1></center>

            <?php

            $dbh = new PDO("mysql:host=localhost;dbname=rmusic","root","");
            if(isset($_POST['submit'])){
                $songname=$_POST['songname'];
                $singer=$_POST['singer'];

                $songimg = file_get_contents($_FILES['songimg']['tmp_name']);
                $imgtype=$_FILES['songimg']['type'];

                $songfile= file_get_contents($_FILES['songfile']['tmp_name']);
                $atype=$_FILES['songfile']['type'];
                
                $Year=$_POST['Year'];

                $stmt = $dbh->prepare("insert into songs values('',?,?,?,?,?,?,?)");

                move_uploaded_file($_FILES['songimg']['tmp_name'], "images/".$_FILES['songimg']['name']);
                move_uploaded_file($_FILES['songfile']['tmp_name'], "audio/".$_FILES['songfile']['name']);

                $stmt->bindParam(1,$songname);
                $stmt->bindParam(2,$singer);
                $stmt->bindParam(3,$songimg);
                $stmt->bindParam(4,$songfile);
                $stmt->bindParam(5,$imgtype);
                $stmt->bindParam(6,$atype);
                $stmt->bindParam(7,$Year);
                $stmt->execute();
                
                $success = "Uploaded successfully.";

            }

            ?>

            <h10>New song upload:</h10><br><br>

            <form method="POST" enctype="multipart/form-data">
                <h11>Song Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="songname"></h11><br> 
                <h11>Singer Name:&nbsp;
                        <input type="text" name="singer"></h11><br> 
                <h11>Year: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="Year"></h11><br><br>  
                <h11>Album Image:&nbsp;
                        <input type="file" name="songimg"></h11><br><br>   
                <h11>Browse MP3:&nbsp;&nbsp;
                        <input type="file" name="songfile"></h11><br><br>  

                <?php if(isset($success)) { ?>
					<div class="alert alert-success">
                        
							<?php echo $success;?>

					</div>
				<?php } ?>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn" name="submit" value="Submit">
            </form>

            <h2>Available Music</h2>
            <center><table>
                <tr>
                    <th>Sl. No.</th>
                    <th>SONG TITLE</th>
                    <th>SINGER</th>
                    <th>YEAR</th>
                </tr>

                <?php
                    $stat = $dbh->prepare("select * from songs");
                    $stat->execute();
                    while($row=$stat->fetch()){
                        echo "
                                <tr>
                                    <td><id=".$row['id']."'>" .$row['id']."&nbsp;&nbsp;&nbsp;</td>
                                    <td><id=".$row['id']."'>" .$row['songname']."&nbsp;&nbsp;&nbsp;</td>
                                    <td><id=".$row['id']."'>" .$row['singer']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td><id=".$row['id']."'>" .$row['Year']."</td>
                                </tr>
                             ";
                    }
                ?>        
            </table></center>
        </div></div>
</body>
<footer>
        <?php include('footer.php'); ?> 
</footer>    
</html>