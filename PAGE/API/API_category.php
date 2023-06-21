<?php
require_once( 'module_apis.php' );
//error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){

    case 'carrousel_categories':
        carrousel_categoriess();
    break;

    case 'list_categories':
        list_categories();
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




function carrousel_categoriess(){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> carrousel_categories( '', '', '', 1,  1, '../../'),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}



function list_categories(){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> list_categoriess(),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}



?>