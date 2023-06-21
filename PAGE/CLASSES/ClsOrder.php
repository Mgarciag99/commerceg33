<?php
require_once( 'clsConex.php' );

class order{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
    
    function get( $id = '', $status = '', $date = '', $total = '', $user = '', $direction = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM orderp";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE ord_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND ord_id = $id";
        }
        
        if( strlen( $status ) > 0 ){
            $sql.= " AND ord_status = $status";
        }
        
        if( strlen( $date ) > 0 ){
            $sql.= " AND ord_date LIKE '%$date%'";
        }
         
        if( strlen( $total ) > 0 ){
            $sql.= " AND ord_total = $total";
        }
 
        if( strlen( $user ) > 0 ){
            $sql.= " AND ord_usuario = $user";
        }

        if( strlen( $direction ) > 0 ){
            $sql.= " AND ord_direction = '$direction'";
        }

        if( strlen( $situation ) > 0 ){
            $sql.= " AND ord_situation = $situation";
        }

        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id = '', $status = '', $date = '', $total = '', $user = '', $direction = '', $situation = 1 ){

        $sql = "";
        $sql.= "INSERT INTO orderp";
        $sql.= " VALUES ( $id, $status, CURDATE(), '$total', $user, '$direction', $situation );";
      // echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function update( $id = '', $status = '',  $total = '' ){

        $sql = "";
        $sql.= "UPDATE orderp";
        $sql.= " SET ord_status = $status,";
        $sql.= " ord_total = $total";

        $sql.= " WHERE ord_id = $id ";
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
        $sql.= "UPDATE orderp";
        $sql.= " SET ord_situation = $situacion ";
        $sql.= " WHERE ord_id = $id ";
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
        $sql = "SELECT max( ord_id ) as max ";
		$sql.= " FROM orderp;";
        $max = $this->db->query( $sql );
        return $max;
   
    }



   
}
?>