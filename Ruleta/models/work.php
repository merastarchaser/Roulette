<?php   //intento de generar un hilo para gestionar la ejecución automatica de la aplicación desde el servidor.(No terminada)
    class AsyncOperation extends Thread {
    
        public static $status;
        public function __construct($arg) {
            $this->arg = $arg;
        }
    
        public function run() {
            while(true){
                AsyncOperation::$status = mt_rand(1, 10);
                sleep(5000);
            }
        }
    }
?>