<?php 
class Bet
{                               //Clase para la inserción y obtención de datos en la Apuesta.
    private $id;
    private $user_id;
    private $game_id;
    private $colour;
    private $bet_cash;

    public function __constructor($id, $user_id, $game_id, $colour, $bet_cash)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->game_id = $game_id;
        $this->colour = $colour;
        $this->bet_cash = $bet_cash;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getGameId()
    {
        return $this->game_id;
    }

    public function setGameId($game_id)
    {
        $this->game_id = $game_id;
    }

    public function getColour()
    {
        return $this->colour;
    }

    public function setColour($colour)
    {
        $this->colour = $colour;
    }

    public function getBetCash()
    {
        return $this->bet_cash;
    }

    public function setBetCash($bet_cash)
    {
        $this->bet_cash = $bet_cash;
    }
}
?>