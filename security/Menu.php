
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  </head>
  <body>
  <br><br>

        <center>
        <?php

            session_start();
            $myusername = $_SESSION['name'];
            $mypassword = $_SESSION['pass'];
            $myrole = $_SESSION['role'];


            $registers = mysqli_query($mysqli,"SELECT * FROM Exam_Users WHERE Usuario='$myusername' AND Password='$mypassword'");
            $num_rows = mysqli_num_rows($registers);
            $row = mysqli_fetch_assoc($registers);
        ?>
        </center>
        <br><br>

        <center>
       
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://sumaleeboxinggym.com/wp-content/uploads/2018/06/Generic-Profile-1600x1600.png" alt="Card image cap" width="200" height="200">
                <div class="card-body">
                    <h5 class="card-title"><?php echo "<font size=5>".$myusername."</font>";?></h5>
                    <p class="card-text">
                        <?php 
                            if($myrole == 1) {
                                echo "<font size=3>[Administrador]</font>";
                            }
                            elseif($myrole == 2) {
                                echo "<font size=3>[Usuario]</font>";
                            }
                        ?>
                    </p>
                    
                    <?php 

if($myrole == "1" ){
echo '        
            <div>
                <form action="NuevoUsuario.php" method="POST">
                    <center>
                    <button type="submit" class="btn btn-outline-success btn-lg btn-block">Agregar Usuario</button>
                    </center>
                </form>
            </div>
        ';

        echo '        
        <div>
            <form action="BorrarU.php" method="POST">
                <center>
                <button type="submit" class="btn btn-outline-danger btn-lg btn-block">Borrar usuario</button>
                </center>
            </form>
        </div>
    ';

    echo '        
    <div>
        <form action="ConsultarU.php" method="POST">
            <center>
            <button type="submit" class="btn btn-outline-warning btn-lg btn-block">Consultar usuarios</button>
            </center>
        </form>
    </div>
';
                        
}
if($myrole == "1" ||$myrole =="2" ){
#echo '<div><center><a href="http://192.168.100.22:81" class="btn btn-outline-info btn-lg btn-block" role="button" aria-disabled="false">Livestream</a></center></div>';
echo '        
<br>            
<div>
                <form action="VerImagenes.php" method="POST">
                    <center>
                    <button type="submit" class="btn btn-outline-dark btn-lg btn-block">Fotografías</button>
                    </center>
                </form>
            </div>
        ';
echo '        
            <div>
                <form action="VerVideos.php" method="POST">
                    <center>
                    <button type="submit" class="btn btn-outline-dark btn-lg btn-block">Videos</button>
                    </center>
                </form>
            </div>
        ';
                        
}
?>
<br>
<a href="https://t.me/joinchat/4a97i9gs271iMTRh">
<img src="https://download.logo.wine/logo/Telegram_(software)/Telegram_(software)-Logo.wine.png" alt="Telegram Group" width="100" height="100">

                </div>
            </div>
        </center>

        <br><br>
        <div>
            <form action="index.php" method="POST">
                <center>
                    <button type="submit" class="btn btn-danger btn-lg btn-block">Log out</button>
                </center>
            </form>
        </div>
        


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
