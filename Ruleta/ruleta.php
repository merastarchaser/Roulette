<?php
include_once ('auth/login.php');
session_start();
if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
    header("location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['bet'])) {
        require_once ('actions/new_bet.php');
    }
}

$user = Login::currentUser();
?>
	<!DOCTYPE html>
<html lang="es">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Ruleta | Casino</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link href="css/ruleta.css" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <style>
            *{
                box-sizing: border-box;
             }
            .ruleta{
                display:block;
                position:relative;
            }

            .option{
                width:100px;
                height:100px;
                display:inline-block;
            }

            .option.red{
                background:red;
            }

            .option.green{
                background:green;
            }

            .option.black{
                background:black;
            }

            .point{
                position:absolute;
                width: 0; 
                height: 0; 
                border-left: 20px solid transparent;
                border-right: 20px solid transparent;
                border-top: 20px solid white;
            }
            
            
            .point.red{                            
                top:0;
                left:30px;
            }

            .point.black{
                top:0;
                left:133px;
            }
            
            .point.green{
                top:0;
                left:237px;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            var actions = ['red','black','green'];  //se insertan valores de los colores en arrreglo actions.
            var result = <?php echo isset($result) ? "'" . $result . "'" : 'null' ?> ; //se le asigna el valor de la variable $result obtenida por el worker.php 

            function play(result){
                var ruleta = $('.ruleta');
                if(ruleta.length){           //se asignan la cantidad de iteraciones a la ruleta
                    var end = 10;
                    
                    function iterator(result, arr, next , end, delay){     //función para el cambio de posición del cursor de la ruleta
                        next  = next >= arr.length  ? 0 : next; 
                        var action = arr[next];
                        console.log(action);
                        //movimiento del cursor
                        ruleta.find('.point').removeClass('red').removeClass('black').removeClass('green').addClass(action);
                        next++;
                        end--;
                        if(end > 1 || action != result){
                            setTimeout(function() {
                                requestAnimationFrame(function(){     
                                    iterator(result,arr,next,end,delay);
                                })
                            }, delay);
                        }else if(action == result){
                            return 
                        }
                    }

                    requestAnimationFrame(function(){
                        iterator(result, actions, 0 , end, 200);   //carga la animación con un retardo de 200 milisegundos entre los cambios de posición.
                    })
                }
            }

            $(document).ready(function(){
                if(result){
                    play(result);
                }
            });
        </script>
    </head>
    <body>
    <div class="container">
    <div class="card card1-container">
        
        <div class='ruleta'>
            <div class='point red'></div>
            <div class='option red'></div>
            <div class='option black'></div>
            <div class='option green'></div>
        </div>
        <div>
            <?php
            if (isset($errors)) {
                foreach ($errors as $error) {
                    ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>Aviso</strong> 
                        <?php echo $error;?>
                    </div>
                <?php
                }
            }
            if (isset($messages)) {
                foreach ($messages as $message) {        
                    ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Aviso</strong>
                        <?php echo $message; ?>   
                    </div> 
                <?php 
                }
            }

                ?>
            ¡Apuesta!
            <form method="post" accept-charset="utf-8" action="ruleta.php" name="loginform" autocomplete="off" class="form-signin">
                <div>
                    <label for="colour">Color</label>
                    <select name="colour">
                        <option value='red'>Rojo</option>
                        <option value='black'>Negro</option>
                        <option value='green'>Verde</option>
                    </select>
                </div>
                <div>
                    <label for="cash">Apostar <small><?php echo "entre " . ($user->getCash() * 0.08) . " y " . ($user->getCash() * 0.15) ?></small></label>
                    <input type="number" name="cash" value="<?php echo $user->getMinCash(); ?>" min="<?php echo $user->getMinCash(); ?>" max="<?php echo $user->getMaxCash(); ?>" />
                </div>
                <input type="submit" value="Apostar" name="bet" class="btn btn-lg btn-success btn-block btn-signin"></input>
                </form>
                <footer>
            </br><a href="change_password.php">Cambiar Contraseña</a></br>
            <a href="edit_user.php">Editar Usuario</a></br>
            <a href="logout.php">Salir</a>
        </footer>
        </div>
        </div>
    </body>
</html>