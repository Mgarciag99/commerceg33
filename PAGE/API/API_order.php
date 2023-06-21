<?php
require_once( 'module_apis.php' );
error_reporting(0);
$request = $_REQUEST[ 'request' ];
$request = trim( $request );

switch( $request ){
    
    case 'add_products_to_order':
        $arrCarShop        =  $_REQUEST[ 'arrCarShop' ];
        $orderId           =  $_REQUEST[ 'orderId' ];

        add_products_to_order( $arrCarShop, $orderId );
    break;
    
    case 'add_order_detail_data':
        $order           =  $_REQUEST[ 'orderId' ];
        $name           =  $_REQUEST[ 'name' ];
        $surname           =  $_REQUEST[ 'surname' ];
        $phone           =  $_REQUEST[ 'phone' ];
        $mail           =  $_REQUEST[ 'mail' ];
        $direction           =  $_REQUEST[ 'direction' ];
        $department           =  $_REQUEST[ 'department' ];
        $municipe           =  $_REQUEST[ 'municipe' ];
        $name_fact           =  $_REQUEST[ 'name_fact' ];
        $nit_fact           =  $_REQUEST[ 'nit_fact' ];
        $direction_fact           =  $_REQUEST[ 'direction_fact' ];

        add_order_detail_data( $order, $name, $surname, $phone, $mail, $direction, $department, $municipe, $name_fact, $nit_fact, $direction_fact );

    break;

    case "confirm_order":
        $order           =  $_REQUEST[ 'orderId' ];
        $total           =  $_REQUEST[ 'total' ];
        $arrCarShop        =  $_REQUEST[ 'arrCarShop' ];

        confirm_order( $order, $total, $arrCarShop );
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

function confirm_order( $order, $total, $arrCarShop ){
    $arrResponse = array();
    $ClsOrder = new order();
    if( $total != '' && $order != '' ){
        ///delete
        $arrCarShop = json_decode( $arrCarShop );
        $update = $ClsOrder->update( $order, 2, $total );
        
        if( $update ){
            $aux = 0;
            $ClsPro = new product();
            for( $i = 0; $i < sizeof( $arrCarShop ); $i++ ){
                //generate Id
                $productId = (int)$arrCarShop[ $i ]->pro_id;
                $quantity = (int)$arrCarShop[ $i ]->quantity;
                $stock = (int)$arrCarShop[ $i ]->pro_stock;
                $productName = $arrCarShop[ $i ]->pro_name;

                $stockUpdate = ( $stock - $quantity );

                $result = $ClsPro->update_stock( $productId, $stockUpdate );
                if( $result ){
                    $aux++;
                }
            
            }

            if(  $aux == sizeof( $arrCarShop ) ){
                $arrResponse = array(
                    "status"	=> true,
                    "data" 	=> [],
                    "message" 	=> "Orden Confirmada, Gracias nos comunicaremos con su persona"
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

function add_products_to_order( $arrCarShop, $order ){

    $arrResponse = array();
    $ClsDetailOrder = new orderDetail();
    if( $arrCarShop != '' && $order != '' ){
        $sql = '';
        $arrCarShop = json_decode( $arrCarShop );
        ///delete
        $delete = $ClsDetailOrder->delete( $order );
        if( $delete ){

            $orderId = $ClsDetailOrder->generateId( $order );
            $id = $orderId->fetch_object()->max;
            $id++;
            $aux = 0;

            for( $i = 0; $i < sizeof( $arrCarShop ); $i++ ){
                //generate Id
                $productId = $arrCarShop[ $i ]->pro_id;
                $quantity = $arrCarShop[ $i ]->quantity;
                $result = $ClsDetailOrder->save( $id, $order, $productId, $quantity );
                if( $result ){
                    $aux++;
                }
            }
            
            if( $aux == sizeof( $arrCarShop ) ){
                $arrResponse = array(
                    "status"	=> true,
                    "data" 	=> [],
                    "message" 	=> "Productos Agregados Correctamente"
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

function add_order_detail_data( $order, $name, $surname, $phone, $mail, $direction, $department, $municipe, $name_fact, $nit_fact, $direction_fact  ){
    $arrResponse = array();
    $ClsDetailOrderData = new orderDetailData();
    if( $order != '' ){
        ///delete
        $delete = $ClsDetailOrderData->delete( $order );
        if( $delete ){

            $orderId = $ClsDetailOrderData->generateId( $order );
            $id = $orderId->fetch_object()->max;
            $id++;
            $save = $ClsDetailOrderData->save( $id, $order, $name, $surname, $phone, $mail, $direction, $department, $municipe, $name_fact, $nit_fact, $direction_fact, 1 );
            //$savers = 0;
            if( $save ){
                $arrResponse = array(
                    "status"	=> true,
                    "data" 	=> [],
                    "message" 	=> "Datos Guardados Correctamente"
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
?>