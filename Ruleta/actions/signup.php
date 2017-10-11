<?php
    include_once('models/entities/users.php');
    include_once('models/dao/users_dao.php');
    
    if (empty($_POST['username'])){
        $errors[] = "Nombres vacíos";
    } elseif (empty($_POST['password'])){
        $errors[] = "Apellidos vacíos";
    }
    $user = new User('',$_POST['username'],$_POST['password'],10000,1);
    $user_dao = new UserDao();
    if($user_dao->create($user)){
        array_push($messages, 'Ingreso correcto');
        header("location: ruleta.php");
    }
?>