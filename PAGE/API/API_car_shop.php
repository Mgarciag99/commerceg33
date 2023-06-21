<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){
   
    
    case 'get_product_by_id':
        $id                 = $_REQUEST[ 'id' ];
        $quantity           = $_REQUEST[ 'quantity' ];
        $levelFile           = $_REQUEST[ 'levelFile' ];


        get_product_by_id( $id, $quantity, $levelFile );
    break;


    case 'validate_stock':
        $id                 = $_REQUEST[ 'id' ];
        $quantity           = $_REQUEST[ 'quantity' ];

        validate_stock( $id, $quantity );
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



function get_product_by_id( $id, $quantity, $levelFile ){
    
    $arrResponse = array();

    if( $id != '' && $quantity != '' ){
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
           $arrData[ 'quantity' ] = $quantity;

            //get image
            $imageProduct = $ClsPro->get_image_product( '', $arrData[ 'pro_id' ], '', '', 1, true );

            if( $imageProduct ){
                
                while ( $image = $imageProduct->fetch_object() ){
                    $imagePicture = $image->pic_image;
                }
                
                if( $imagePicture != '' ){
                    $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $imagePicture;
                    if( file_exists('../../SYSTEM/IMAGES/PRODUCT/' . $imagePicture ) ){   
                        $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $imagePicture;
                    }else{
                        $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
                    }
                }else{
                    $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
                }

            }else{
                    
                $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
    
            }


           

            $arrData[ 'pro_image' ] = $picture;

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


function validate_stock( $id, $quantity ){
    
    $arrResponse = array();

    if( $id != '' ){
        $ClsPro = new product();
        $products = $ClsPro->get( $id );
        $arrData = array();

        while( $product = $products->fetch_object() ){

           $arrData[ 'pro_stock' ] = $product->pro_stock;
        }

        if( ( int )$quantity <= ( int )$arrData[ 'pro_stock' ] ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> $arrData,
                "message" 	=> "Data obtenida satisfactoriamente"
            );
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "No existe mas Stock de este producto"
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


?>