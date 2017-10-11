<?php
include_once ('conexion/connection.php');
include_once ('models/entities/users.php');

class BetDao                                   //Gestión de datos de la apuesta.
{
    public $conn;

    public function __construct()
    {
        $this->conn = BDConnection::connect();
    }

    public function new_bet($bet)
    {
        $sql = "INSERT INTO bet (user_id, game_id, colour , bet_cash)
                VALUES(" . $bet->getUserId() . "," . $bet->getGameId() . ",'" . $bet->getColour() . "'," . $bet->getBetCash() . ");";
    
        $query_new_insert = mysqli_query($this->conn, $sql);
        return $query_new_insert ? $bet : null;
    }

    public function getBetToUser($user_id, $game_id){
        $bets = [];
        $sql = "SELECT * FROM bet WHERE user_id = ".$user_id." AND game_id =".$game_id;
        $fetch = mysqli_query($this->conn, $sql);
        while ($row = mysqli_fetch_array($fetch)) {
            $bet = $this->parse($row);
            array_push($bets, $bet);
        }
        return $bets;
    }

    private function parse($row){
        $user = new Bet($row["id"], $row["user_id"], $row["game_id"], $row["colour"], $row["bet_cash"]);
    }
}

?>