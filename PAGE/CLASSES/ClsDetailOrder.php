<?php
require_once( 'clsConex.php' );

class orderDetail{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
    
    function get( $id = '', $order = '', $product = '', $quantity = '' ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM order_detail";
        $sql.= " INNER JOIN product";
        $sql.= " ON pro_id = proord_product";
        $sql .= " WHERE 1 = 1";
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND proord_id  = $id";
        }
        
        if( strlen( $order ) > 0 ){
            $sql.= " AND proord_order  = $order";
        }
        
        if( strlen( $product ) > 0 ){
            $sql.= " AND proord_product = $product";
        }
         
        if( strlen( $quantity ) > 0 ){
            $sql.= " AND proord_quantity = $quantity";
        }
 


        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id = '', $order = '', $product = '', $quantity = '' ){

        $sql = "";
        $sql.= " INSERT INTO order_detail";
        $sql.= " VALUES ( $id, $order, $product, $quantity ); ";
        $save = $this->db->query( $sql );
		$result = false;
		if( $save ){
			$result = true;
		}
     
		return $result;
    
    }

    function generateId( $order ){

        $sql = '';
        $sql = "SELECT max( proord_id ) as max ";
		$sql.= " FROM order_detail ";
        $sql.= " WHERE proord_order = $order;";
        $max = $this->db->query( $sql );
        return $max;
   
    }
    function update( $id = '', $status = '', $date = '', $total = '', $user = '', $direction = '' ){

        $sql = "";
        $sql.= "UPDATE orderp";
        $sql.= " SET ord_status = $status,";
        $sql.= " ord_date = '$date',";
        $sql.= " ord_total = $total,";
        $sql.= " ord_usuario = $user,";
        $sql.= " ord_direction = '$direction',";

        $sql.= " WHERE ord_id = $id ";
     //   echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function delete( $order ){

        $sql = "";
        $sql.= "DELETE FROM order_detail";
        $sql.= " WHERE proord_order = $order ";
     //   echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

   



   
}
?>