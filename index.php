<!DOCTYPE HTML>
<html>
<head>
    <title>RMusic</title>
    <style>
        <?php include 'css/main.css'; ?>
    </style>
</head>
<body>    
    <div class="main-box">
        <img src="pics/1.jpg" width="100%" height="200px">
        <div class="top-nav">
            <a href="login.php"><img src="pics/login-icon.png" width=15px height=15px> Admin Login</a>
        </div>
        
        <div class="inside-box">
            <h2>Trending Songs</h2>
            <table>
                    <?php
                        $i=0;
                        $dbh = new PDO("mysql:host=localhost;dbname=rmusic","root","");
                        $stat = $dbh->prepare("select * from songs");
                        $stat->execute();
                        while($row=$stat->fetch())
                        {
                    ?>
                            <div class="song-diplay">
                            <?php 
                                if($i%4 == 0){
                                    echo "<tr>";
                                }
                               echo "<th><id=".$row['id']."'>".$row['songname']." - ".$row['singer']."
                                <embed src='data:".$row['imgtype'].";base64,".base64_encode($row['songimg'])."' height='150' width='300' border-radius='5px'/>
                                <audio controls>
                                    <source src='data:".$row['atype'].";base64,".base64_encode($row['songfile'])."'/>
                                </audio></th>";
                                if($i%4 == 3){
                                    echo "</tr>";
                                }
                                $i++;
                            ?>
                            </div>
                    <?php } ?>  
             </table>               
            <h2>Remix/Mashups</h2>
            <h5>Comming Soon..</h5>
        
        </div>
    </div>
</body>
<footer>
        <?php include('footer.php'); ?> 
</footer>   
</html>