<?php
class Ruleta
{
    static $RED = array('win' => 2, 'colour' => 'red');      //Se asignan las ganancias que proporciona cada color. 
    static $GREEN = array('win' => 15, 'colour' => 'green'); //'win' es el número por el que se va a multiplicar el saldo apostado, en caso de ganar.
    static $BLACK = array('win' => 2, 'colour' => 'black');

    static function play()     
    {
        $weights = array('green' => 0.02, 'red' => 0.49, 'black' => 0.4901);  //se establecen los porcentajes de probabilidades a cada color, verde->2%, rojo->49% y negro->49%.
        $rand = (float)rand() / (float)getrandmax();  //se genera un número aleatorio entre los porcentajes establecidos.
        foreach ($weights as $value => $weight) {
            if ($rand < $weight) {
                $result = $value;
                break;
            }
            $rand -= $weight;
        }
        if ($result == 'red') {
            return Ruleta::$RED;
        }
        else if ($result == 'black') {
            return Ruleta::$BLACK;
        }
        else if ($result == 'green') {
            return Ruleta::$GREEN;
        }
        return null;
    }
}
?>