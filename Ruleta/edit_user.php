<?php 
include_once('auth/login.php');
$login = new Login();

// preguntamos si estamos logueados:
if ($login->isUserLoggedIn() == true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include_once('actions/edit_user.php');
    }else{
        $user = Login::currentUser();
    }
} 
    
   
    ?>

<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Editar Usuario | Ruleta Casino</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <!-- CSS  -->
   <link href="css/edituser.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
 <div class="container">
        <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="img/Usuario.png" />
        <?php 
            if (isset($messages)){
                ?>
                <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>¡Bien hecho!</strong>
                        <?php
                            foreach ($messages as $message) {
                                    echo $message;
                                }
                            ?>
                </div>
                <?php
            }

            if (isset($errors)){
                ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Error!</strong> 
                        <?php
                            foreach ($errors as $error) {
                                    echo $error;
                                }
                            ?>
                </div>
                <?php
            }
        ?>
            <h>Editar Usuario </h>
            <form method="post" accept-charset="utf-8" action="edit_user.php" name="loginform" autocomplete="off" role="form" class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input class="form-control" placeholder="Nombre usuario" <?php echo isset($user) ? 'value="'.$user->getUserName().'"' : ""?> name="username" type="text" value="" autofocus="" required  >
                <input class="form-control" placeholder="Saldo" <?php echo isset($user) ? 'value="'.$user->getCash().'"' : ""?> name="cash" type="number" value="" autocomplete="off" required>
                <p id="profile-name" class="profile-name-card"></p>
                <button type="submit" class="btn btn-lg btn-success btn-block btn-signin" name="login" id="submit">Guardar Cambios</button>
                <a href="ruleta.php">Volver </a>

            </form><!-- /form -->
            
        </div><!-- /card-container -->
    </div><!-- /container -->
  </body>
</html>
<?php
    