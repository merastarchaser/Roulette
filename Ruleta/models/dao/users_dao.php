<?php
include_once ('conexion/connection.php');
include_once ('models/entities/users.php');
class UserDao
{                                                           //Gestión de usuarios.
    public $conn;

    public function __construct()
    {
        $this->conn = BDConnection::connect();
    }

    public function create($user) 
    {
        $user_password_hash = password_hash($user->getPassword(), PASSWORD_DEFAULT);   //se encripta la contraseña usando el algoritmo bcrypt.
        $sql = "INSERT INTO users (user_name, password , cash, status)
                VALUES('" . $user->getUserName() . "','" . $user_password_hash . "', 10000, 1 );";
        $query_new_user_insert = mysqli_query($this->conn, $sql);
        //$user->setId($query_new_user_insert->insert_id);
        return $query_new_user_insert ? $user : null;
    }

    public function update($user)   
    {
        $sql = "UPDATE users SET user_name = '" . $user->getUserName() . "', cash=" . $user->getCash() . ", status=" . ($user->isStatus() ? 1 : 0) . " WHERE id=" . $user->getId() . ";";
        $query_update_user = mysqli_query($this->conn, $sql);
        return $query_update_user;
    }

    public function updatePassword($user, $password)  
    {
        $user_password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='" . $user_password_hash . "' WHERE id=" . $user->getId() . ";";
        $query_update_user = mysqli_query($this->conn, $sql);
        return $query_update_user;
    }

    public function getOne($id)
    {
        $sql = "SELECT * FROM users WHERE id = " . $id;
        $fetch = $this->conn->query($sql);
        $user = null;
        if ($row = mysqli_fetch_array($fetch)) {
            $user = $this->parse($row);
        }
        return $user;
    }

    public function fetch()
    {
        $users = [];
        $sql = "select * from users";
        $fetch = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_array($fetch)) {
            $user = $this->parse($row);
            array_push($users, $user);
        }
        return $users;
    }

    public function doLogin($user_name, $password)
    {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM users WHERE user_name = '" . $user_name . "' AND status = 1;";
        $fetch = $this->conn->query($sql);
        $user = null;
        while ($row = mysqli_fetch_array($fetch)) {
            $user = $this->parse($row);
            break;
        }
        return $user && password_verify($password, $user->getPassword()) ? $user : null;
    }

    public function delete()
    {

    }

    protected function parse($row)
    {
        $user = new User($row["id"], $row["user_name"], $row["password"], $row["cash"], $row["status"]);
        return $user;
    }

    public static function getInstance()
    {
        return new UserDao();
    }

}
?>