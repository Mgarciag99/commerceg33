<?php

    require_once( 'module_apis.php' );

    //error_reporting(0);

    $size = $_FILES[ "image" ][ "size" ];
    $file = $_FILES[ "image" ][ "name" ];
    $type = $_FILES[ "image" ][ "type" ];

	$category = $_REQUEST[ 'category' ];
    $typeFile = $_REQUEST['type'];
    $arrResponse = array();

    if ( $file != "" && $category != '' && $typeFile != '' ) {

        $ClsCat = new category();
        $ext = pathinfo( $file, PATHINFO_EXTENSION ); // jpg, png, etc...
        $stringPicture = str_shuffle( $category.uniqid() ) . '.' . $ext;
        
        $idPicture = $ClsCat->generateidImage();
        $id = $idPicture->fetch_object()->max;
        $id++;
        $result = $ClsCat->saveImage( $id, $category, $stringPicture, $typeFile );

        if( $result ){
            
            $path =  "../IMAGES/CATEGORY/" . $stringPicture;

            if ( move_uploaded_file( $_FILES[ 'image' ][ 'tmp_name' ], $path ) ) {
                
                $arrResponse = array(
                    "status" => true,
                    "data" 	=> [],
                    "codeImage" => $id,
                    "message" => "Archivo subido Exitosamente"
                );


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
    