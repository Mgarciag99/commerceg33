<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){

    case 'carrousel_subcategories':
        $codeCategory = $_REQUEST[ 'codeCategory' ];
        carrousel_subcategoriess( $codeCategory );
    break;


    case 'list_categories':
        $codeCategory = $_REQUEST[ 'codeCategory' ];
        list_subcategoriess( $codeCategory );
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



function carrousel_subcategoriess( $codeCategory ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=>  carrousel_subcategories( $codeCategory , '', '', '', 2, 1, '../../'),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function list_subcategoriess( $codeCategory ){

    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=>  list_subcategories( '', $codeCategory ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}



?>