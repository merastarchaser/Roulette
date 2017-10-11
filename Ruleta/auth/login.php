<?php
include_once ("models/dao/users_dao.php");
/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
   
    public $errors = array();   //array para la recolección de errores.
   
    public $messages = array();   //array para la recolección de mensajes neutrales /exitosos.

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // crear/leer sesión, totalmente necesario.
        session_start();

        //se chequean posibles acciones de log in:
        // si el usuario intenta cerrar sesión (se lleva a cabo cuando el usuario da click en 'Salir')
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via  datos POST 
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in con datos del POST
     */
    private function dologinWithPostData()
    {
        // se chequea el contenido del formulario del log in.
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        }
        elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        }
        elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {
            $user_dao = new UserDao();
            // si no hay errores de conexión 
            if ($user_dao != null) {
                // se loguea con los datos ingresados por POST
                $user = $user_dao->doLogin($_POST['user_name'], $_POST['user_password']);
                // si el usuario existe
                if ($user != null) {
                    $_SESSION['user_id'] = $user->getId();
                    //$_SESSION['user'] = $user;
                    $_SESSION['user_login_status'] = 1;
                }
                else {
                    $this->errors[] = "Usuario y/o contraseña no coinciden.";
                }
            }
            else {
                $this->errors[] = "Problema de conexión de base de datos.";
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // eliminar la sesión del usuario.
        $_SESSION = array();
        session_destroy();
        // se retorna mensaje de desconexión.
        $this->messages[] = "Has sido desconectado.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }

    public static function currentUser(){
        $user_dao = new UserDao();
        return $user_dao->getOne($_SESSION['user_id']);
    }
}
