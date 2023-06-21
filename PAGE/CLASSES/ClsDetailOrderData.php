<?php
require_once( 'clsConex.php' );

class orderDetailData{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
    
    function get( $id = '', $order = '', $name ='', $surname = '', $phone = '', $mail = '', $direction = '', $department = '', $municipe = '', $nameFact = '', $nitFact = '', $directionFact = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM order_detail_data";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE ordt_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND ordt_id = $id";
        }

        if( strlen( $order ) > 0 ){
            $sql.= " AND ordt_order = $order";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND ordt_name LIKE '%$name%'";
        }

        if( strlen( $surname ) > 0 ){
            $sql.= " AND ordt_surname LIKE '%$surname%'";
        }

        if( strlen( $phone ) > 0 ){
            $sql.= " AND ordt_phone LIKE '%$phone%'";
        }
        
        if( strlen( $mail ) > 0 ){
            $sql.= " AND ordt_mail LIKE '%$mail%'";
        }

        if( strlen( $direction ) > 0 ){
            $sql.= " AND ordt_direction LIKE '%$direction%'";
        }

        if( strlen( $department ) > 0 ){
            $sql.= " AND ordt_department LIKE '%$department%'";
        }

        if( strlen( $municipe ) > 0 ){
            $sql.= " AND ordt_municipe LIKE '%$municipe%'";
        }

        if( strlen( $nameFact ) > 0 ){
            $sql.= " AND ordt_name_fact LIKE '%$nameFact%'";
        }

        if( strlen( $nitFact ) > 0 ){
            $sql.= " AND ordt_nit_fact LIKE '%$nitFact%'";
        }

        if( strlen( $directionFact ) > 0 ){
            $sql.= " AND ordt_direction_fact LIKE '%$directionFact%'";
        }
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id = '', $order = '', $name ='', $surname = '', $phone = '', $mail = '', $direction = '', $department = '', $municipe = '', $nameFact = '', $nitFact = '', $directionFact = '', $situation = 1 ){

        $sql = "";
        $sql.= " INSERT INTO order_detail_data";
        $sql.= " VALUES ( $id, $order, '$name', '$surname', '$phone', '$mail', '$direction', '$department', '$municipe', '$nameFact', '$nitFact', '$directionFact', 1 ); ";
        $save = $this->db->query( $sql );
		$result = false;
		if( $save ){
			$result = true;
		}
     
		return $result;
    
    }

    function generateId( $order ){

        $sql = '';
        $sql = "SELECT max( ordt_id  ) as max ";
		$sql.= " FROM order_detail_data ";
        $sql.= " WHERE ordt_order = $order;";
        $max = $this->db->query( $sql );
        return $max;
   
    }
    function update( $id = '', $status = '', $date = '', $total = '', $user = '', $direction = '' ){

        $sql = "";
        $sql.= "UPDATE order_detail_data";
        $sql.= " SET ordt_status = $status,";
        $sql.= " ordt_date = '$date',";
        $sql.= " ordt_total = $total,";
        $sql.= " ordt_usuario = $user,";
        $sql.= " ordt_direction = '$direction',";

        $sql.= " WHERE ordt_id = $id ";
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
        $sql.= "DELETE FROM order_detail_data";
        $sql.= " WHERE ordt_order = $order ";
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