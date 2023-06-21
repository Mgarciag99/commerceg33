<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];

switch( $request ){
    case 'save':
        $codeCategory   = $_REQUEST[ 'codeCategory' ];
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        save( $codeCategory, $name, $description );
    break;

    case 'table':
        $id          = $_REQUEST[ 'id' ];
        $codeCategory   = $_REQUEST[ 'codeCategory' ];
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        $situation   = $_REQUEST[ 'situation' ];
        table( $id, $codeCategory, $name, $description, $situation );
    break;
    
    case 'select':
        $id             = $_REQUEST[ 'id' ];
        $codeCategory   = $_REQUEST[ 'codeCategory' ];
        select( $id, $codeCategory );
    break;
    
    case 'update':
        $id          = $_REQUEST[ 'id' ];
        $codeCategory   = $_REQUEST[ 'codeCategory' ];
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        update( $id, $codeCategory, $name, $description );
    break;

    case 'delete':
        $id          = $_REQUEST[ 'id' ];
        $codeCategory   = $_REQUEST[ 'codeCategory' ];
        delete( $id, $codeCategory );
    break;

    case 'table_pictures_subcategory':
        $subcategory    = $_REQUEST[ 'subcategory' ];
        $type        = $_REQUEST[ 'type' ];
        $levelFile        = $_REQUEST[ 'levelFile' ];

        table_pictures_subcategoryy( $subcategory, $type, $levelFile );
    break;

    case 'select_sub_category':
        $id          = $_REQUEST[ 'id' ];
        $codeCategory= $_REQUEST[ 'codeCategory' ];
        $name        = $_REQUEST[ 'name' ];
        $description = $_REQUEST[ 'description' ];
        $situation   = $_REQUEST[ 'situation' ];
        select_sub_categoryy( $id, $codeCategory, $name, $description, $situation );
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


function save( $codeCategory, $name, $description ){

    $arrResponse = array();

    if( $name != '' && $description != '' && $codeCategory != '' ){
        $ClsSubCat = new subcategory();
        $idCategory = $ClsSubCat->generateId();
        $id = $idCategory->fetch_object()->max;
        $id++;
        $result = $ClsSubCat->save( $id, $codeCategory, $name, $description );
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

function table( $id, $codeCategory, $name, $description, $situation ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_subcategories( $id, $codeCategory, $name, $description, 1 ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

function select( $id, $codeCategory ){
    
    $arrResponse = array();

    if( $id != '' ){
        $ClsSubCat = new subcategory();
        $subcategories = $ClsSubCat->get( $id, $codeCategory );
        $arrData = array();

        while( $subcategorie = $subcategories->fetch_object() ){

           $arrData[ 'subcat_id' ] = $subcategorie->subcat_id;
           $arrData[ 'subcat_category' ] = $subcategorie->subcat_category;
           $arrData[ 'subcat_name' ] = $subcategorie->subcat_name;
           $arrData[ 'subcat_description' ] = $subcategorie->subcat_description;
           $arrData[ 'subcat_situation' ] = $subcategorie->subcat_situation;

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
function update( $id, $codeCategory, $name, $description ){
    
    $arrResponse = array();

    if( $id != '' && $name != '' && $description != '' && $codeCategory != '' ){

        $ClsSubCat = new subcategory();
        $result = $ClsSubCat->update( $id, $codeCategory, $name, $description );
        
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

function delete( $id, $codeCategory ){

    $arrResponse = array();

    if( $id != ''  ){

        $ClsSubCat = new subcategory();
        $result = $ClsSubCat->delete( $id, $codeCategory, 0 );
        
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

function table_pictures_subcategoryy( $subcategory, $type, $levelFile ){

    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> table_pictures_category( $subcategory, $type, $levelFile ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}


function select_sub_categoryy( $id, $codeCategory, $name, $description, $situation ){
    
    $arrResponse = array();
    
    $arrResponse = array(
        "status"	=> true,
        "data" 	=> select_subcategories( $id, $codeCategory, $name, $description, $situation ),
        "message" 	=> "Datos Obtenidos Satisfactoriamente"
    );

    echo json_encode( $arrResponse );

}

?>