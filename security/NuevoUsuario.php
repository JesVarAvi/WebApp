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
<form action="" method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" placeholder="usuario1" name="username" maxlength="20">
    </div>
    
    <div class="form-group col-md-3">
      <label for="username">Password</label>
      <input type="password" class="form-control" id="password1" placeholder="****" name="password1" maxlength="20">
    </div>
    

    
    <div class="form-group col-md-3">
      <label for="username">Confirm password</label>
      <input type="password" class="form-control" id="password2" placeholder="****" name="password2" maxlength="20">
    </div>
  </div>
  
  <div class="form-group col-md-3">
      <label for="username">Correo</label>
      <input type="text" class="form-control" id="Correo" placeholder="@hotmail.com" name="Correo" maxlength="55">
    </div>
  
  <select name = 'ROL'>
      <option value ='1'> Administrador </option>
      <option value ='2'> Usuario </option>

    </div>
  </div>
  </select>
  <br>
  <br>
  <button type="submit" class="btn btn-success">Crear nuevo usuario</button>
</form>

        <br><br>
        <div>
            <form action="Menu.php" method="POST">
                <center>
                    <button type="submit" class="btn btn-info btn-lg">Menú</button>
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


<?php

    session_start();    
    $myusername = $_SESSION['name'];
    $mypassword = $_SESSION['pass'];

    $username = $_POST['username'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $name =$_POST['name'];
    $rol = $_POST['ROL'];
    $Correo = $_POST['Correo'];

    

    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "db3287_";
    $db_name = "Test";
    $mysqli = new mysqli($db_servername,$db_username,$db_password,$db_name);
    $check_username = mysqli_query($mysqli,"SELECT * FROM Users WHERE User='$username'");
    $check_duplicity = mysqli_num_rows($check_username);
    $row = mysqli_fetch_assoc($result);

    if((is_null($username)) || (is_null($password1)) || (is_null($password2))  || (is_null($rol)) || (is_null($Correo)) ) {
        echo("TODOS LOS CAMPOS SON OBLIGATORIOS.");
    }
    else {
    
        if($check_duplicity == 0) {

            if ($password1 == $password2) {           

                        $password3 = md5($password1);

                        $SQL = mysqli_query($mysqli,"INSERT INTO Users (Email,Password,Level,User) VALUES('$Correo','$password3',$rol,'$username');");
                        mysqli_commit($SQL); 
                        echo("Usuario nuevo registrado exitosamente.");                       
                    }                  
            else {
                echo("Las contraseñas no coinciden.");
            }
        }
        else {
            echo("El usuario ya existe.");
        }
    }
?>
