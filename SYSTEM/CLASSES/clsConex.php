<?php 
class Database{


    public static function connect(){
		$db = new mysqli('localhost', 'root', '', 'e_commerce');
		$db->query("SET NAMES 'utf8'");
		return $db;
	}


}



?>