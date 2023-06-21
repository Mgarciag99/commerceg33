<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){
    case 'save':
        $category           = $_REQUEST[ 'category' ];
        $subCategory        = $_REQUEST[ 'subCategory' ];
        $name               = $_REQUEST[ 'name' ];
        $description        = $_REQUEST[ 'description' ];
        $stock              = $_REQUEST[ 'stock' ];
        $price              = $_REQUEST[ 'price' ];
        save( $category, $subCategory, $name, $description, $stock, $price );
    break;

    case 'table':
        $id                 = $_REQUEST[ 'id' ];
        $category           = $_REQUEST[ 'category' ];
        $subCategory        = $_REQUEST[ 'subCategory' ];
        $name               = $_REQUEST[ 'name' ];
        $description        = $_REQUEST[ 'description' ];
        $stock              = $_REQUEST[ 'stock' ];
        $price              = $_REQUEST[ 'price' ];
        $situation          = $_REQUEST[ 'situation' ];

        table( $id, $category, $subCategory, $name, $description, $stock, $price, $situation );
    break;
    
    case 'select':
        $id          = $_REQUEST[ 'id' ];
        select( $id );
    break;
    
    case 'update':
        $id                 = $_REQUEST[ 'id' ];
        $category           = $_REQUEST[ 'category' ];
        $subCategory        = $_REQUEST[ 'subCategory' ];
        $name               = $_REQUEST[ 'name' ];
        $description        = $_REQUEST[ 'description' ];
        $stock              = $_REQUEST[ 'stock' ];
        $price              = $_REQUEST[ 'price' ];
        update( $id, $category, $subCategory, $name, $description, $stock, $price );
    break;

    case 'delete':
        $id          = $_REQUEST[ 'id' ];
        delete( $id );
    break;
    ////////////////////////////////////////////////////////////////////////
    case 'table_pictures_product':
        $product          = $_REQUEST[ 'product' ];
        $levelFile        = $_REQUEST[ 'levelFile' ];

        table_pictures_productt( $product, $levelFile );
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


function save( $category, $subCategory, $name, $description, $stock, $price ){

    $arrResponse = array();

    if( $category != '' && $subCategory != '' && $name != '' && $description != '' && $stock != '' && $price != '' ){

        $ClsPro = new product();
        $idProduct = $ClsPro->generateId();
        $id = $idProduct->fetch_object()->max;
        $id++;
        $result = $ClsPro->save( $id, $category, $subCategory, $name, $description, $stock, $price );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Producto Insertado Correctamente"
            );
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Error en el servidor"
            );
        }

    }else{
        $arrResponse = array(
			"status"	=> false,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}

function table( $id, $category, $subCategory, $name, $description, $stock, $price, $situation = 1 ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_products( $id, $category, $subCategory, $name, $description, $stock, $price, $situation ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function select( $id ){
    
    $arrResponse = array();

    if( $id != '' ){
        $ClsPro = new product();
        $products = $ClsPro->get( $id );
        $arrData = array();

        while( $product = $products->fetch_object() ){

           $arrData[ 'pro_id' ] = $product->pro_id;
           $arrData[ 'pro_category' ] = $product->pro_category;
           $arrData[ 'pro_subcategory' ] = $product->pro_subcategory;
           $arrData[ 'pro_name' ] = $product->pro_name;
           $arrData[ 'pro_description' ] = $product->pro_description;
           $arrData[ 'pro_stock' ] = $product->pro_stock;
           $arrData[ 'pro_price' ] = $product->pro_price;
           $arrData[ 'pro_situation' ] = $product->pro_situation;


        }

        $arrResponse = array(
			"status"	=> true,
			"data" 	=> $arrData,
			"message" 	=> "Data obtenida satisfactoriamente"
		);

    }else{
        $arrResponse = array(
			"status"	=> false,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}
function update( $id, $category, $subCategory, $name, $description, $stock, $price ){
    
    $arrResponse = array();

    if( $id != '' && $category != '' && $subCategory != '' && $name != '' && $description != '' && $stock != '' && $price != '' ){

        $ClsPro = new product();
        $result = $ClsPro->update( $id, $category, $subCategory, $name, $description, $stock, $price );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Producto Actualizado Correctamente"
            );
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Error en el servidor"
            );
        }

    }else{
        $arrResponse = array(
			"status"	=> true,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}

function delete( $id ){

    $arrResponse = array();

    if( $id != ''  ){

        $ClsPro = new product();
        $result = $ClsPro->delete( $id, 0 );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Producto Eliminado Correctamente"
            );
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Error en el servidor"
            );
        }

    }else{
        $arrResponse = array(
			"status"	=> true,
			"data" 	=> [],
			"message" 	=> "Verifique los valores"
		);
    }
    
    echo json_encode( $arrResponse );

}






////////////////////////////////////////////////////////////////////////
function table_pictures_productt( $product, $levelFile ){

    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_pictures_product( $product, $levelFile ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}




?>