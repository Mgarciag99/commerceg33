<?php 
require_once( 'module_user.php' );

validate_login();


?>
<!DOCTYPE html>
<html lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= head( '../' ); ?>
    <link rel="stylesheet" href="../ASSETS.V_01/css/style-managment.css">
<body>
     
    <!-- modal -->
    <?= login_frm(); ?>
    <!-- end modal -->

    <!-- car shopping panel -->
    <?= shopping_cart_panel();?>
    <!-- end car shopping panel -->

    <!-- navbar -->
    <?= navbar( '../' )?>

    <!-- end navbar -->
    <div class="space"></div>
    <div class="space"></div>

    <!-- shopping cart-->
    <?= shopping_cart(); ?>
    <!-- end cart-->
    <div class="space"></div>
    <!-- section -->
    <section>
        <div class="container">
            <div class="main">
                <div class="main-sidebar">
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
                            <?= sidebar_user( 1 )?>
                        </ul>
                    </div>
                    <button style = "margin-bottom: 1em;"class="button-item" onclick="window.history.back();"><i class="fas fa-arrow-circle-left"></i> Regresar</button>
                    <?= button_close_session(); ?>
                </div>
                <div class="main-content">
                    <h2 class="title">Mis Pedidos</h2>    
                    <div class="container-orders">
                        <?php 
                        $ClsOrder = new order();
                        $result = $ClsOrder->get( '', '', '', '', $_SESSION[ 'codeUser' ], '', 1 );
                        
                        if( $result->num_rows != 0 ):
                            
                            while( $order = $result->fetch_object() ):
                                $orderId = trim( $order->ord_id );
                                $orderStatus = trim( $order->ord_status );
                                $orderDate = trim( $order->ord_date );
                                $orderTotal = trim( $order->ord_total );
                                $orderUser = trim( $order->ord_usuario );
                                $orderDirection = trim( $order->ord_direction );
                                $orderSituation = trim( $order->ord_situation );
                                
                                switch( $orderStatus ){
                                    case 1:
                                        $txtSituation = 'En Proceso';
                                    break;
                                    case 2:
                                        $txtSituation = 'Entregado';
                                    break;
                                }
                                
                                ?>
                            <a href="details_order.php?order=<?= $orderId ?>" title="ver detalle de pedido">
                                <div class="card-order" >
                                    <div class="c-one">
                                        <h2>Orden # 00<?= $orderId ?></h2>
                                        <span>Fecha: <?= $orderDate ?></span>
                                        <h4>Total <?= $orderTotal ?></h4>
                                    </div>
                                    <div  class="c-two">
                                        <span class="badge-info">
                                            <?= $txtSituation ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        <?php
                            endwhile;
                        endif;
                        ?>


                        
                        
                    </div>
                </div>
            </div>
           
        </div>
        
    </section>
    <!-- end section -->
    <?= footer( '../' ); ?>
    <?= script_js( '../' ); ?>
    <!-- <script src="../ASSETS.V_01/js/scripts_modules/category/category.js"></script> -->
    <script src="../ASSETS.V_01/js/scripts_modules/user/user.js"></script>


</body>
</html>