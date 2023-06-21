<?php

    require_once( 'module_apis.php' );

    //error_reporting(0);

    $size = $_FILES[ "image" ][ "size" ];
    $file = $_FILES[ "image" ][ "name" ];
    $type = $_FILES[ "image" ][ "type" ];

	$codeImage = $_REQUEST[ 'codeImage' ];
	$product = $_REQUEST[ 'product' ];

    $arrResponse = array();

    if ( $file != "" && $product != '' ) {

        $ClsProd = new product();
        //data last image by product
        $resultImage = $ClsProd->get_image_product( $codeImage, $product );

        while( $row = $resultImage->fetch_object() ){
            $lastPicture = $row->pic_image;
            $idPicture = $row->pic_id;
        }


        $stringPicture = str_shuffle( $product.uniqid() ) . '.png';
        $result = $ClsProd->changeImage( $idPicture, $product, $stringPicture );

        if( $result ){
            
            $path =  "../IMAGES/PRODUCT/" . $stringPicture;

            if ( move_uploaded_file( $_FILES[ 'image' ][ 'tmp_name' ], $path ) ) {
                
               

                $arrResponse = array(
                    "status" => true,
                    "data" 	=> [],
                    "message" => "Archivo subido Exitosamente"
                );

                if (file_exists( '../IMAGES/PRODUCT/' . $lastPicture ) ){
                    unlink( "../IMAGES/PRODUCT/" . $lastPicture );
                }


            } else {
                
                $arrResponse = array(
                    "status" => false,
                    "data" => [],
                    "message" => "Error al subir el archivo"
                );
            
            }
        } else {
			
            $arrResponse = array(
                "status" => false,
                "data" 	=> [],
                "message" => "Verificar Valores"
            );
            
		
        }
	} else {
        
        $arrResponse = array(
            "status" => false,
            "data" 	=> [],
            "message" => "Archivo vacio"
        );
        
    }

    echo json_encode( $arrResponse );


?>
    