<?php

    require_once( 'module_apis.php' );

    //error_reporting(0);

    $size = $_FILES[ "image" ][ "size" ];
    $file = $_FILES[ "image" ][ "name" ];
    $type = $_FILES[ "image" ][ "type" ];

	$codeImage = $_REQUEST[ 'codeImage' ];
	$category = $_REQUEST[ 'category' ];
    $typeFile = $_REQUEST['type'];

    $arrResponse = array();

    if ( $file != "" && $category != '' ) {

        $ClsCat = new category();
        //data last image by category
        $resultImage = $ClsCat->get_image_category( $codeImage, $category, '', $typeFile );

        while( $row = $resultImage->fetch_object() ){
            $lastPicture = $row->pic_image;
            $idPicture = $row->pic_id;
        }


        $stringPicture = str_shuffle( $category.uniqid() ) . '.png';
        $result = $ClsCat->changeImage( $idPicture, $category, $stringPicture );

        if( $result ){
            
            $path =  "../IMAGES/CATEGORY/" . $stringPicture;

            if ( move_uploaded_file( $_FILES[ 'image' ][ 'tmp_name' ], $path ) ) {
                
               

                $arrResponse = array(
                    "status" => true,
                    "data" 	=> [],
                    "message" => "Archivo subido Exitosamente"
                );

                if (file_exists( '../IMAGES/CATEGORY/' . $lastPicture ) ){
                    unlink( "../IMAGES/CATEGORY/" . $lastPicture );
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
    