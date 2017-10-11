<?php
include_once ('conexion/connection.php');
include_once ('models/entities/game.php');
class GameDao                          //Gestión de partidas.
{
    private $time = 120;
    public $conn;

    public function __construct()
    {
        $this->conn = BDConnection::connect();
    }

    public function currentGame($user_id)
    {
        $game = $this->exits($user_id);
        if ($game == null) {
            $sql = "insert into game (result_colour, date , user_id) values (null,now()," . $user_id . ")";
            $fetch = mysqli_query($this->conn, $sql);
            if ($fetch) {
                return $this->exits($user_id);
            }
        }
        return $game;
    }

    public function exits($user_id)                    //verificar existencia de partidas.
    {
        $sql = "select * from game where user_id = " . $user_id . " and result_colour is null";
        $fetch = mysqli_query($this->conn, $sql);
        $game = null;
        while ($row = mysqli_fetch_array($fetch)) {
            $game = $this->parse($row);
            break;
        }
        return $game;
    }

    public function endGame($game){                          //finalizar partida y actualizar el valor del color obtenido.
        $sql = "update game set result_colour ='".$game->getResultColour()."'";
        $fetch = mysqli_query($this->conn, $sql);
        return $fetch;
    }


    private function parse($row)
    {
        return new Game($row['id'], $row['result_colour'], $row['date']);
    }
}
?>