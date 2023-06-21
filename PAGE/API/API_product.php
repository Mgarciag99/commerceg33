<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){

    case 'get_products':
        $id = $_REQUEST[ 'id' ];
        $category = $_REQUEST[ 'category' ];
        $subcategory = $_REQUEST[ 'subcategory' ];
        $name = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        $price = $_REQUEST[ 'price' ];
        $stock = $_REQUEST[ 'stock' ];
        $situation = $_REQUEST[ 'situation' ];
        $levelFile = $_REQUEST[ 'levelFile'];
        $last_id = $_REQUEST[ 'last_id'];

    
        get_productss( $id, $category, $subcategory, $name, $description, $price, $stock, $situation, $levelFile, $last_id );
    break;
    

    case 'carrousel_pictures_by_product':

        $id = $_REQUEST[ 'id' ];
        $product = $_REQUEST[ 'product' ];
        $image = $_REQUEST[ 'image' ];
        $date = $_REQUEST[ 'date' ];
        $situation = $_REQUEST[ 'situation' ];
        $levelFile = $_REQUEST[ 'levelFile' ];

        carrousel_pictures_productss( $id, $product, $image, $date, $situation, $levelFile );
    break;

    case 'search_products':
       
        $name = $_REQUEST[ 'name' ];
    
        search_productss( $name );
    break;


    default:
        $arrResponse = array();
        $arrResponse = array(
            "status"	=> false,
            "data" 	=> [],
            "message" 	=> "Verifique la peticion"
        );
        echo json_encode( $arrResponse );

    break;
}




function get_productss( $id, $category, $subcategory, $name, $description, $price, $stock, $situation, $levelFile, $last_id ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> trim( products( $id, $category, $subcategory, $name, $description, $price, $stock, $situation, $levelFile, $last_id ) ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function search_productss(  $name ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> trim( search_list_products(  $name ) ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}



function carrousel_pictures_productss( $id, $product, $image, $date, $situation, $levelFile ){
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> trim( carrousel_pictures_products( $id, $product, $image, $date, $situation, $levelFile ) ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );
}

?>