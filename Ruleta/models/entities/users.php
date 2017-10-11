<?php
    class User{      //Clase para gestionar inserción y obtención de datos del usuario. (GETTERS Y SETTERS)
        private $id;
        private $user_name;
        private $password;
        private $cash;
        private $status;

        public function __construct($id, $user_name, $password, $cash, $status){
            $this->id = $id;
            $this->user_name = $user_name;
            $this->password = $password;
            $this->cash = $cash;
            $this->status = $status;
        }

        public function getId(){
            return $this->id;
        }
        
        public function setId($id){
            $this->id = $id;
        }

        public function getUserName(){
            return $this->user_name;
        }
        
        public function setUserName($user_name){
            $this->user_name = $user_name;
        }

        public function getPassword(){
            return $this->password;
        }
        
        public function setPassword($password){
            $this->password = $password;
        }

        public function getCash(){
            return $this->cash;
        }
        
        public function setCash($cash){
            $this->cash = $cash;
        }

        public function isStatus(){
            return $this->status;
        }
        
        public function setStatus($status){
            $this->status = $status;
        }

        public function getMinCash(){
            return $this->getCash() > 1000 ? $this->getCash() * 0.08 : $this->getCash();
        }
        
        public function getMaxCash(){
            return $this->getCash() > 1000 ? $this->getCash() * 0.15 : $this->getCash();
        }
    }
?>