<link href="Login.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Iniciar sesión</h3>
			</div>
			<div class="card-body">
      <form action="" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="Correo" id="Correo" class="form-control" placeholder="Email">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" name="password" id="password" class="form-control" placeholder="Contraseña">
					</div>
					<div class="form-group">
						<input type="submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Sistema de seguridad "CVChidori"
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>






<?php

    session_start();
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "db3287_";
    $db_name = "Test";

    $mysqli = new mysqli($db_servername,$db_username,$db_password,$db_name);
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $mycorreo = $_POST['Correo'];
        $mypassword = $_POST['password'];
        $mypassword = md5($mypassword);
        $_SESSION['Correo'] = $mycorreo;
        $_SESSION['pass'] = $mypassword;
	

        $registers = mysqli_query($mysqli,"SELECT * FROM Users WHERE Email='$mycorreo' AND Password='$mypassword'");
        $num_rows = mysqli_num_rows($registers);
        $row = mysqli_fetch_assoc($registers);
        $_SESSION['role'] = $row['Level'];
        $_SESSION['name'] = $row['User'];


        if($num_rows == 1) {
          header("location: Menu.php");
        }
        elseif($num_rows == 0) {
          header("location: index.php");
        }
    }

?>
