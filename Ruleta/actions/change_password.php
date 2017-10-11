<?php
    include_once('models/entities/users.php');
    include_once('models/dao/users_dao.php');
    
    if (empty($_POST['password'])){                                  //verificación de campos vacíos.
        $errors[] = "contraseña vacía";
    }elseif (empty($_POST['repeat_password'])){
        $errors[] = "repetición de contraseña vacía";
    }
    if($_POST['password']==$_POST['repeat_password']){               //verificar que la contraseña y repetición de contraseña coincidan.
        $user = Login::currentUser();
        $user_dao = new UserDao();
        if($user_dao->updatePassword($user,$_POST['password'])){     //Inserción de nueva contraseña.
            array_push($messages, 'Ingreso correcto');
            header("location: ruleta.php");
        }
    }else{
        $errors[] = "Las contraseñas no coinciden";
    }
?>