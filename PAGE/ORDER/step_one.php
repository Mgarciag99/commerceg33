<?php 

require_once( 'module_order.php' );
validate_login();
$ClsOrder = new order();
$result = $ClsOrder->get( '', 1, '', '', $_SESSION[ 'codeUser' ], '', 1 );
$validateStepOne = 0;

if( $result->num_rows == 0 ){

    $idOrder = $ClsOrder->generateId();
    $id = $idOrder->fetch_object()->max;
    $id++;
    
    $result = $ClsOrder->save( $id, 1, '', '', $_SESSION[ 'codeUser' ], '', 1 );
   // var_dump($result);die();
    if( $result ){
        $orderId = $id;
    }else{

    }
}else{
    while( $order = $result->fetch_object() ){
        $orderId = trim( $order->ord_id );
        $orderStatus = trim( $order->ord_status );
        $orderDate = trim( $order->ord_date );
        $orderTotal = trim( $order->ord_total );
        $orderUser = trim( $order->ord_usuario );
        $orderDirection = trim( $order->ord_direction );
        $orderSituation = trim( $order->ord_situation );

    }


    $ordenNo = $orderId;

}

///MAKE CONSULT DETAILS ORDER
$ClsOrder = new order();
$ClsDetailOrder = new orderDetail();
$ClsDetailOrderData = new orderDetailData();

$validateStepOne = $ClsDetailOrder->get( '', $orderId )->num_rows;
$validateStepTwo = $ClsDetailOrderData->get( '', $orderId )->num_rows;
$validateStepThree = $ClsOrder->get( $orderId, 2 )->num_rows;

//var_dump( $validateStepThree );die();

?>
<!DOCTYPE html>
<html lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= head( '../' ); ?>
    <link rel="stylesheet" href="../ASSETS.V_01/css/style-managment.css">
    <link rel="stylesheet" href="../ASSETS.V_01/css/style-steps-order.css">

<body>
     
    <!-- modal -->
    <?= login_frm(); ?>
    <!-- end modal -->

    <!-- navbar -->
    <?= navbar( '../' )?>

    <!-- end navbar -->
    <div class="space"></div>
    <div class="space"></div>
    <div class="space"></div>
    <!-- section -->
    <section>
        <div class="container">
            <div class="main">
                <div class="main-sidebar">
                    <input type="hidden" id="orderId" name="orderId" value="<?= $orderId ?>">
                    <h2 class="title">Orden No. <?= $orderId ?></h2>
                    <div class="main-sidebar-header">
                        <div>
                            <label>Hola</label>
                            <h2><?= strtoupper( $_SESSION[ 'user' ] )?></h2>
                            <label>marcopc303@gmail.com</label>
                        </div>
                        <div>
                            <img width="100%" src="../ASSETS.V_01/img/images.jpg" alt="">
                        </div>
                    </div>
                    <div class="main-section">
                        <ul>
                            <?= sidebar_order( 1 ); ?>
                        </ul>
                    </div>
                    <button style = "margin-bottom: 1em;"class="button-item" onclick="window.history.back();"><i class="fas fa-arrow-circle-left"></i> Regresar</button>
                    
                    <?= button_close_session(); ?>

                </div>
                <div class="main-content">
                    <h2 class="title">Productos Agregados al Carrito</h2>
                    <input type="hidden" id="validateStepOne" value="<?= $validateStepOne ?>">
                    <input type="hidden" id="validateStepTwo" value="<?= $validateStepTwo ?>">
                    <input type="hidden" id="validateStepThree" value="<?= $validateStepThree ?>">


                    <div class="list-panel">                
                        <ul id="container-items-car-shop">                   
                        </ul>
                        <h4 class="total">Total: </h4>
                        <h5 class="total mr-1" id="total" >$. 10.00 </h5>
                    </div>
                    <button class="button-item button-medium" onclick="addProductsToOrder();"><i class="fas fa-shopping-cart"></i> Agregar la Orden</button>

                </div>
            </div>
           
        </div>
        
    </section>
    <!-- end section -->
    <?= footer( '../' ); ?>
    <?= script_js( '../' ); ?>
    
    <script src="../ASSETS.V_01/js/scripts_modules/user/user.js"></script>
    <script src="../ASSETS.V_01/js/scripts_modules/order/order.js"></script>
    <script>
        window.addEventListener( 'load', ()=>{
           // validateForm( 1 );
        });
    </script>

</body>
</html>