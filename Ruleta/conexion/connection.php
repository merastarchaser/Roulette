<?php
    class BDConnection{
		public static function connect(){
			return new mysqli("localhost", "root", "", "ruleta");
		}
	}
?>