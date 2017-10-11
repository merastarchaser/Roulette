<?php
    include_once('auth/login.php');
    include_once('models/entities/users.php');
    include_once('models/dao/users_dao.php');
                                                 //Se establece la conexión y se reciben datos ingresados por POST en el formulario de edit_user.php
    if (empty($_POST['username'])){             //verificación de campos vacíos.
        $errors[] = "Nombres vacío";
    }elseif (empty($_POST['cash'])){
        $errors[] = "Saldo vacío";
    }
    
    $user = Login::currentUser();                //inserción de datos nuevos en el usuario.
    $user->setUserName($_POST['username']);
    $user->setCash($_POST['cash']);
    $user_dao = new UserDao();
    if($user_dao->update($user)){
        array_push($messages, 'Ingreso correcto');
        header("location: ruleta.php");
    }
?>