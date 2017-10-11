<?php
include_once ('models/dao/bet_dao.php');
include_once ('models/dao/users_dao.php');
include_once ('models/dao/game_dao.php');
include_once ('models/entities/bet.php');
include_once ('auth/login.php');
include_once ('models/worker.php');

if (empty($_POST['colour'])) {                   //Verificar existencia de ingresos vacíos.
    $errors[] = "No se ha elegido color.";
}
elseif (empty($_POST['cash'])) {
    $errors[] = "No se ha ingresado saldo.";
}
else {                                         //Se crea un nuevo juego, se reciben valores del formulario y se aplican acciones.
    $game_dao = new GameDao();
    $current_user = Login::currentUser();
    $current_game = $game_dao->currentGame($current_user->getId());
    if ($current_game && $current_user) {
        $bet = new Bet();
        $bet->setBetCash($_POST['cash']);
        $bet->setColour($_POST['colour']);
        $bet->setGameId($current_game->getId());
        $bet->setUserId($current_user->getId());

        if ($bet->getBetCash() >= $current_user->getMinCash() && $bet->getBetCash() <= $current_user->getMaxCash()) { //se verifica que el valor ingresado en la apuesta esté entre el 8% y 15% del saldo.
            $bet_dao = new BetDao();
            if ($bet_dao->new_bet($bet)) {             //se crea una nueva apuesta y se debita el valor ingresado al saldo del usuario.
                $user_dao = new UserDao();
                $current_user->setCash($current_user->getCash() - $bet->getBetCash());
                if ($user_dao->update($current_user)) {
                    $result_prev = Ruleta::play();     //se inicia el juego (se juega con los colores y sus respectivos porcentajes de probabilidad)
                    $result = $result_prev['colour'];    //se captura el color ingresado y se registra en el game.
                    $current_game->setResultColour($result);
                    if ($game_dao->endGame($current_game)) {    //se finaliza el juego y se verifica si el color ingresado es el mismo del resultado.
                        if ($result == $bet->getColour()) {          //en caso de acertar el color se le da la ganancia al saldo del usuario y se muestra mensaje de acierto.
                            $win_cash = $bet->getBetCash() * $result_prev['win'];
                            $current_user->setCash($current_user->getCash() + $win_cash);
                            if ($user_dao->update($current_user)) {
                                $messages[] = ' Felicidades, has ganado. :)';
                            }
                        }
                        else {
                            $errors[] = ' Perdiste, intentalo de nuevo. :(';     //En caso de no acertar con el color del resultado.
                        }
                    }
                }
                else {
                    $errors[] = "Error al actualizar datos";
                }
            }
            else {
                $errors[] = "Error al generar la apuesta";
            }
        }
        else {                                                                                                 
            $errors[] = "El dinero apostado" . $bet->getBetCash() . " debe estar entre (" . $current_user->getMinCash() . "-" . $current_user->getMaxCash() . ")";
        }
    }
}
?>