<?php
require_once( 'clsConex.php' );

class subcategory{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
 
    function get( $id = '', $codeCategory = '', $name = '', $description = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM subcategory";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE subcat_situation IN( $situation )";
        }

        if( strlen( $codeCategory ) > 0 ){
            $sql.= " AND subcat_category = $codeCategory";
        }

        if( strlen( $id ) > 0 ){
            $sql.= " AND subcat_id = $id";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND subcat_name LIKE '%$name%'";
        }
        
        if( strlen( $description ) > 0 ){
            $sql.= " AND subcat_description LIKE '%$description%'"; 
        }
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id, $codeCategory, $name, $description ){

        $sql = "";
        $sql.= "INSERT INTO subcategory";
        $sql.= " VALUES ( $id, $codeCategory, '$name', '$description', 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function update( $id, $codeCategory, $name, $description ){

        $sql = "";
        $sql.= "UPDATE subcategory";
        $sql.= " SET subcat_name = '$name',";
        $sql.= " subcat_description = '$description'";
        $sql.= " WHERE subcat_id = $id ";
        $sql.= " AND subcat_category = $codeCategory ";

     //   echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function delete( $id, $codeCategory, $situacion ){

        $sql = "";
        $sql.= "UPDATE subcategory";
        $sql.= " SET subcat_situation = $situacion ";
        $sql.= " WHERE subcat_id = $id ";
        $sql.= " AND subcat_category = $codeCategory ";

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
        $sql = "SELECT max( subcat_id ) as max ";
		$sql.= " FROM subcategory;";
        $max = $this->db->query( $sql );
        return $max;
   
    }

    ///FILES

    function generateidImage(){

        $sql = '';
        $sql = "SELECT max( pic_id ) as max ";
		$sql.= " FROM pictures_categories;";
        $max = $this->db->query( $sql );
        return $max;
   
    }

    function saveImage( $id, $categorie, $image, $type ){

        $sql = "";
        $sql.= "INSERT INTO pictures_categories";
        $sql.= " VALUES ( $id, $categorie, '$image', $type, 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function changeImage( $id, $categorie, $image ){

        $sql = "";
        $sql.= "UPDATE pictures_categories";
        $sql.= " SET pic_image = '$image'";
        $sql.= " WHERE pic_id = $id";
        $sql.= " AND pic_subcategory = $categorie";

        $save = $this->db->query( $sql );
        //echo $sql;
		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }


    function get_image_subcategory( $id = '', $subcategory = '', $image = '', $type = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM pictures_categories";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE pic_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND pic_id = $id";
        }
        
        if( strlen( $subcategory ) > 0 ){
            $sql.= " AND pic_subcategory = $subcategory";
        }
        
        if( strlen( $image ) > 0 ){
            $sql.= " AND pic_image LIKE '%$image%'"; 
        }

        if( strlen( $type ) > 0 ){
            $sql.= " AND pic_type = $type";
        }

        $sql.= " ORDER BY pic_id DESC LIMIT 1;";
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }


}
?>