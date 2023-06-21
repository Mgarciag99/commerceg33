<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){
    case 'save':
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        save( $name, $description );
    break;

    case 'table':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        $situation   = $_REQUEST[ 'situation' ];
        table( $id, $name, $description, $situation );
    break;
    
    case 'select':
        $id          = $_REQUEST[ 'id' ];
        select( $id );
    break;
    
    case 'update':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        update( $id, $name, $description );
    break;

    case 'delete':
        $id          = $_REQUEST[ 'id' ];
        delete( $id );
    break;
    
    case 'table_pictures_category':
        $category    = $_REQUEST[ 'category' ];
        $type        = $_REQUEST[ 'type' ];
        $levelFile        = $_REQUEST[ 'levelFile' ];

        table_pictures_categoryy( $category, $type, $levelFile );
    break;
    
    case 'select_category':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        $situation   = $_REQUEST[ 'situation' ];
        select_categoryy( $id, $name, $description, $situation );
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


function save( $name, $description ){

    $arrResponse = array();

    if( $name != '' && $description != '' ){

        $ClsCat = new category();
        $idCategory = $ClsCat->generateId();
        $id = $idCategory->fetch_object()->max;
        $id++;
        $result = $ClsCat->save( $id, $name, $description );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Categoria Insertada Correctamente"
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

function table( $id, $name, $description, $situation ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_categories( $id, $name, $description, $situation ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function select( $id ){
    
    $arrResponse = array();

    if( $id != '' ){
        $ClsCat = new category();
        $categories = $ClsCat->get( $id );
        $arrData = array();

        while( $categorie = $categories->fetch_object() ){

           $arrData[ 'cat_id' ] = $categorie->cat_id;
           $arrData[ 'cat_name' ] = $categorie->cat_name;
           $arrData[ 'cat_description' ] = $categorie->cat_description;
           $arrData[ 'cat_situacion' ] = $categorie->cat_situacion;

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
function update( $id, $name, $description ){
    
    $arrResponse = array();

    if( $id != '' && $name != '' && $description != '' ){

        $ClsCat = new category();
        $result = $ClsCat->update( $id, $name, $description );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Categoria Actualizada Correctamente"
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

        $ClsCat = new category();
        $result = $ClsCat->delete( $id, 0 );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Categoria Eliminada Correctamente"
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

function table_pictures_categoryy( $category, $type, $levelFile ){

    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_pictures_category( $category, $type, $levelFile ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function select_categoryy( $id, $name, $description, $situation ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> select_categories( $id, $name, $description, $situation ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}


?>