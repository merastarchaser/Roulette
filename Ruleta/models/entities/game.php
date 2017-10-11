<?php
class Game
{                        //Clase para la obtención e inserción de datos en la partida.
    private $id;
    private $result_colour;
    private $date;

    public function __construct($id, $result_colour, $date)
    {
        $this->id = $id;
        $this->result_colour = $result_colour;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getResultColour()
    {
        return $this->result_colour;
    }

    public function setResultColour($result_colour)
    {
        $this->result_colour = $result_colour;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

}
?>