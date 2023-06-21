<?php
require_once( 'clsConex.php' );

class product{

    private $db;

    public function __construct() {
		$this->db = Database::connect();
	}
 
    function get( $id = '', $category = '', $subcategory = '', $name = '', $description = '', $price = '', $stock = '', $situation = 1 ){

        $sql = '';
        $sql.= "SELECT *";
        $sql.= " FROM product";
        $sql.= " INNER JOIN category";
        $sql.= " ON pro_category = cat_id";
        $sql.= " INNER JOIN subcategory";
        $sql.= " ON pro_subcategory = subcat_id";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE pro_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND pro_id = $id";
        }

        if( strlen( $category ) > 0 ){
            $sql.= " AND pro_category = $category";
        }

        if( strlen( $subcategory ) > 0 ){
            $sql.= " AND pro_subcategory = $subcategory";
        }
        
        if( strlen( $name ) > 0 ){
            $sql.= " AND pro_name LIKE '%$name%'";
        }
        
        if( strlen( $description ) > 0 ){
            $sql.= " AND pro_description LIKE '%$description%'"; 
        }

        if( strlen( $price ) > 0 ){
            $sql.= " AND pro_price LIKE '%$price%'";
        }
        
        if( strlen( $stock ) > 0 ){
            $sql.= " AND pro_stock LIKE '%$stock%'"; 
        }
        $sql.= ' ORDER BY pro_id ASC';
        //echo $sql;
        $result = $this->db->query( $sql );
        return $result;
        
    }

    function save( $id, $category, $subcategory, $name, $description, $stock, $price ){

        $sql = "";
        $sql.= "INSERT INTO product";
        $sql.= " VALUES ( $id, $category, $subcategory, '$name', '$description', $stock, $price, 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function update( $id, $category, $subcategory, $name, $description, $stock, $price ){

        $sql = "";
        $sql.= "UPDATE product";
        $sql.= " SET pro_category = $category,";
        $sql.= " pro_subcategory = $subcategory,";
        $sql.= " pro_name = '$name',";
        $sql.= " pro_description = '$description',";
        $sql.= " pro_price = $price,";
        $sql.= " pro_stock = $stock";

        $sql.= " WHERE pro_id = $id ";
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
        $sql.= "UPDATE product";
        $sql.= " SET pro_situation	 = $situacion ";
        $sql.= " WHERE pro_id = $id ";
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
        $sql = "SELECT max( pro_id ) as max ";
		$sql.= " FROM product;";
        $max = $this->db->query( $sql );
        return $max;
   
    }

    ///FILES

    function generateidImage(){

        $sql = '';
        $sql = "SELECT max( pic_id ) as max ";
		$sql.= " FROM pictures_products;";
        $max = $this->db->query( $sql );
        return $max;
   
    }

    function saveImage( $id, $product, $image ){

        $sql = "";
        $sql.= "INSERT INTO pictures_products";
        $sql.= " VALUES ( $id, $product, '$image', CURDATE(), 1 );";
        //echo $sql;
        $save = $this->db->query( $sql );

		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }

    function changeImage( $id, $product, $image ){

        $sql = "";
        $sql.= "UPDATE pictures_products";
        $sql.= " SET pic_image = '$image'";
        $sql.= " WHERE pic_id = $id";
        $sql.= " AND pic_product = $product";

        $save = $this->db->query( $sql );
        //echo $sql;
		$result = false;
		if( $save ){
			$result = true;
		}
		return $result;
    
    }


    function get_image_product( $id = '', $product = '', $image = '', $date = '', $situation = 1, $limit = true ){

        $sql = "";
        $sql.= "SELECT *";
        $sql.= " FROM pictures_products";
        
        if( strlen( $situation ) > 0 ){
            $sql.= " WHERE pic_situation IN( $situation )";
        }
        
        if( strlen( $id ) > 0 ){
            $sql.= " AND pic_id = $id" ;
        }
        
        if( strlen( $product ) > 0 ){
            $sql.= " AND pic_product = $product";
        }
        
        if( strlen( $image ) > 0 ){
            $sql.= " AND pic_image LIKE '%$image%'"; 
        }

        if( strlen( $date ) > 0 ){
            $sql.= " AND pic_date = $date";
        }

        $sql.= " ORDER BY pic_id DESC";

        if( $limit ){
            $sql.= " LIMIT 1";
        }
        $sql.= ';';
       // echo $sql;   
        $result = $this->db->query( $sql );
        return $result;
        
    }


}
?>