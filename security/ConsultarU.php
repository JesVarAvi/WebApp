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
    $conn = new mysqli($db_servername,$db_username,$db_password,$db_name);
    /*$check_username = mysqli_query($mysqli,"SELECT * FROM Users");
    $check_duplicity = mysqli_num_rows($check_username);
    $row = mysqli_fetch_assoc($check_username);*/

    $sql = "SELECT * FROM Users";
    $result = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function
    echo "<center>";
    echo "<br>";
    echo "<table border='1'>";
    while ($row = mysqli_fetch_assoc($result)) { // Important line !!! Check summary get row on array ..
        echo "<tr>";
        foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
            echo "<td>" . $value . "</td>"; // I just did not use "htmlspecialchars()" function. 
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "</center>"
?>


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
