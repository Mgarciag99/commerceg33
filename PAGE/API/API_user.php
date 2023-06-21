<?php
require_once( 'module_apis.php' );
session_start();
error_reporting(0);
$request = $_REQUEST[ 'request' ];
$request = trim( $request );

switch( $request ){
    case 'login':
        $mail        =  $_REQUEST[ 'mail' ];
        $password    =  $_REQUEST[ 'password' ];

        login( $mail, $password );
    break;


    case 'save':
        $name        =  $_REQUEST[ 'name' ];
        $surname     =  $_REQUEST[ 'surname' ];
        $user        =  $_REQUEST[ 'user' ];
        $mail        =  $_REQUEST[ 'mail' ];
        $password    =  $_REQUEST[ 'password' ];
        $rol         =  $_REQUEST[ 'rol' ];

        save( $name, $surname, $user, $mail, $password, $rol );
    break;

    case 'table':
        $id          = $_REQUEST[ 'id' ];
        $name        = $_REQUEST[ 'name' ];
        $surname     = $_REQUEST[ 'surname' ];
        $user        = $_REQUEST[ 'user' ];
        $mail        = $_REQUEST[ 'mail' ];
        $password    = $_REQUEST[ 'password' ];
        $rol         = $_REQUEST[ 'rol' ];
        $situation   = $_REQUEST[ 'situation' ];

        table( $id,$name, $surname, $user, $mail, $password, $rol, $situation );
    break;
    
    case 'select':
        $id          = $_REQUEST[ 'id' ];
        select( $id );
    break;
    
    case 'updateDataUser':
        $code        =  $_REQUEST[ 'code' ];
        $name        =  $_REQUEST[ 'name' ];
        $surname     =  $_REQUEST[ 'surname' ];
        $mail        =  $_REQUEST[ 'mail' ];
        $password    =  $_REQUEST[ 'password' ];
        updateDataUser( $code, $name, $surname, $mail, $password );
    break;

    case 'delete':
        $id          = $_REQUEST[ 'id' ];
        delete( $id );
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

function validate_login( $mail, $password ){

    
    
}
function login( $mail, $password ){

    $mail = trim( $mail );
    $password = trim( $password );
    $arrResponse = array();
    $ClsUser = new user();
    if( $mail != '' && $password != '' ){

        $user = $ClsUser->get( '', '', '', '', $mail );
        if( $user->num_rows == 1 ){

            while( $usu = $user->fetch_object() ){

                $idUser = $usu->usu_id ;
                $nameUser = $usu->usu_name;
                $surnameUser = $usu->usu_surname;
                $usuUser = $usu->usu_user;
                $usuMail = $usu->usu_mail;
                $usuPassword = $usu->usu_password;
                $usuRol = $usu->usu_rol;

     
             }
             
            if( password_verify( $password, $usuPassword ) ){
                
                $arrResponse = array(
                    "status"	=> true,
                    "data" 	=> [],
                    "message" 	=> "Acceso Correcto" 
                );
                
                ///make a session
                $_SESSION[ 'codeUser' ] = $idUser;
                $_SESSION[ 'user' ] = $usuUser;
                $_SESSION[ 'nameUser' ] = $nameUser;
                $_SESSION[ 'surnameUser' ] = $surnameUser;

            }else{
                $arrResponse = array(
                    "status"	=> false,
                    "data" 	=> [],
                    "message" 	=> "Password Incorrecta" 
                );
            }
            
        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Correo no existente en el sistema" 
            );
        }
       

    }else{
        $arrResponse = array(
            "status"	=> false,
            "data" 	=> [],
            "message" 	=> "Llenar Campos Obligatorios" 
        );
    }

    echo json_encode( $arrResponse );

}

function save( $name, $surname, $user, $mail, $password, $rol ){

    $arrResponse = array();

    if( $user != '' && $mail != '' && $password ){

        $user = trim( $user );
        $mail = trim( $mail );
        $password = trim( $password );

        $ClsUser = new user();
        $validateUser = $ClsUser->validateUser( $user )->num_rows;
        $validateMail = $ClsUser->validateMail( $mail )->num_rows;

        if( $validateUser == 0 && $validateMail == 0 ){
            
            $idUser = $ClsUser->generateId();
            $id = $idUser->fetch_object()->max;
            $id++;
            
            $passwordDecrypt = password_hash( $password, PASSWORD_BCRYPT );

            $result = $ClsUser->save( $id, $name, $surname, $user, $mail, $passwordDecrypt, $rol, 1 );
            
            if( $result ){
                $arrResponse = array(
                    "status"	=> true,
                    "data" 	=> [],
                    "message" 	=> "Usuario Registrado Correctamente, Puedes iniciar Sesion"
                );
            }else{
                $arrResponse = array(
                    "status"	=> false,
                    "data" 	=> [],
                    "message" 	=> "Error en el servidor" . $passwordDecrypt
                );
            }

        }else{
            $arrResponse = array(
                "status"	=> false,
                "data" 	=> [],
                "message" 	=> "Usuario o correo electronico ya estan registrados en el sistema"
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
        $ClsUser = new user();
        $categories = $ClsUser->get( $id );
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
function updateDataUser( $code, $name, $surname, $mail, $password ){
    
    $arrResponse = array();

    if( $code != '' && $name != '' && $surname != '' && $password != '' && $mail != '' ){

        $ClsUser = new user();
        $passwordDecrypt = password_hash( $password, PASSWORD_BCRYPT );

        $result = $ClsUser->update( $code, $name, $surname, '', $mail, $passwordDecrypt, '' );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Usuario Actualizado Correctamente"
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

        $ClsUser = new user();
        $result = $ClsUser->delete( $id, 0 );
        
        if( $result ){
            $arrResponse = array(
                "status"	=> true,
                "data" 	=> [],
                "message" 	=> "Usuario Eliminada Correctamente"
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


?>