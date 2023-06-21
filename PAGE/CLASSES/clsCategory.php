<?php
require_once( 'clsConex.php' );

class category{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
 
    function get( $id = '', $name = '', $description = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM category";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE cat_situacion IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND cat_id = $id";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND cat_name LIKE '%$name%'";
        }
        
        if( strlen( $description ) > 0 ){
            $sql.= " AND cat_description LIKE '%$description%'"; 
        }
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id, $name, $description ){

        $sql = "";
        $sql.= "INSERT INTO category";
        $sql.= " VALUES ( $id, '$name', '$description', 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function update( $id, $name, $description ){

        $sql = "";
        $sql.= "UPDATE category";
        $sql.= " SET cat_name = '$name',";
        $sql.= " cat_description = '$description'";
        $sql.= " WHERE cat_id = $id ";
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
        $sql.= "UPDATE category";
        $sql.= " SET cat_situacion	 = $situacion ";
        $sql.= " WHERE cat_id = $id ";
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
        $sql = "SELECT max( cat_id ) as max ";
		$sql.= " FROM category;";
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
        $sql.= " AND pic_category = $categorie";

        $save = $this->db->query( $sql );
        //echo $sql;
		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }


    function get_image_category( $id = '', $category = '', $image = '', $type = '', $situation = 1, $limit = true ){

        $sql = "";
        $sql.= "SELECT *";
        $sql.= " FROM pictures_categories";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE pic_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND pic_id = $id" ;
        }
        
        if( strlen( $category ) > 0 ){
            $sql.= " AND pic_category = $category";
        }
        
        if( strlen( $image ) > 0 ){
            $sql.= " AND pic_image LIKE '%$image%'"; 
        }

        if( strlen( $type ) > 0 ){
            $sql.= " AND pic_type = $type";
        }

        $sql.= " ORDER BY pic_id DESC";

        if( $limit ){
            $sql.= " LIMIT 1";
        }
        $sql.= ';';
     //   echo $sql;   
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function get_category_picture( $id = '', $name = '', $description = '', $type = 1, $situation = 1, $limit = '' ){

        $sql = "";
        $sql.= "SELECT *";
        $sql.= " FROM category";
        $sql.= " LEFT JOIN pictures_categories";
        $sql.= " ON cat_id = pic_category ";


        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE cat_situacion IN( $situation )";
        }

        if( strlen( $situation ) > 0 ){
            $sql.= " AND pic_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND cat_id = $id";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND cat_name LIKE '%$name%'";
        }

        if( strlen( $type ) > 0 ){
            $sql.= " AND pic_type = $type";
        }
        
        if( strlen( $description ) > 0 ){
            $sql.= " AND cat_description LIKE '%$description%'"; 
        }

        if( strlen( $limit ) > 0 ){
            $sql.= " LIMIT $limit"; 
        }

        $sql.= ';';
      //echo $sql;   
        $result = $this->db->query( $sql );
        return $result;
        
    }
}
?>