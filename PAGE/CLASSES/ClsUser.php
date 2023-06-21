<?php
require_once( 'clsConex.php' );

class user{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
    
    function get( $id = '', $name = '', $surname = '', $user = '', $mail = '', $password = '', $rol = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM users";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE usu_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND usu_id = $id";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND usu_name LIKE '%$name%'";
        }
        
        if( strlen( $surname ) > 0 ){
            $sql.= " AND usu_surname LIKE '%$name%'";
        }
         
        if( strlen( $user ) > 0 ){
            $sql.= " AND usu_user = $user'";
        }
 
        if( strlen( $mail ) > 0 ){
            $sql.= " AND usu_mail = '$mail'";
        }

        if( strlen( $password ) > 0 ){
            $sql.= " AND usu_password = $password'";
        }

        if( strlen( $rol ) > 0 ){
            $sql.= " AND usu_rol = $rol'";
        }

        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id, $name = '' , $surname = '', $user = '', $mail = '', $password = '', $rol = '', $situation = 1 ){

        $sql = "";
        $sql.= "INSERT INTO users";
        $sql.= " VALUES ( $id, '$name', '$surname', '$user', '$mail', '$password', '$rol', CURDATE(), $situation );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function update( $id, $name = '' , $surname = '', $user = '', $mail = '', $password = '', $rol = '' ){

        $sql = "";
        $sql.= "UPDATE users";
        $sql.= " SET usu_name = '$name',";
        $sql.= " usu_surname = '$surname',";
        $sql.= " usu_mail = '$mail',";
        $sql.= " usu_password = '$password'";

        $sql.= " WHERE usu_id = $id ";
     //   echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function delete( $id, $situacion ){

        $sql = "";
        $sql.= "UPDATE users";
        $sql.= " SET usu_situation = $situacion ";
        $sql.= " WHERE usu_id = $id ";
     //   echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function generateId(){

        $sql = '';
        $sql = "SELECT max( usu_id ) as max ";
		$sql.= " FROM users;";
        $max = $this->db->query( $sql );
        return $max;
   
    }


    function validateUser( $user = '' ){

        $sql = '';
        $sql = "SELECT  usu_id ";
		$sql.= " FROM users";

        if( strlen( $user ) > 0 ){
            $sql.= " WHERE usu_user = '$user'";
        }
        
        $usu = $this->db->query( $sql );
        return $usu;
   
    }

    function validateMail( $mail = '' ){

        $sql = '';
        $sql = "SELECT  usu_id ";
		$sql.= " FROM users";

        if( strlen( $mail ) > 0 ){
            $sql.= " WHERE usu_mail = '$mail'";
        }
        
        $usu = $this->db->query( $sql );
        return $usu;
   
    }
    


   
}
?>