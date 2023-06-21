<?php 

require_once( 'module_user.php' );
$order = $_REQUEST['order'];
validate_login();

$ClsOrder = new order();
$result = $ClsOrder->get( $order, '', '', '', $_SESSION[ 'codeUser' ], '', 1 );

//  var_dump( $result );die;

if( $result->num_rows != 0 ){
    $orderDataId = '';
    $orderDataOrder = '';
    $orderDataName = '';
    $orderDataSurname = '';
    $orderDataPhone = '';
    $orderDataMail = '';
    $orderDataDirection = '';
    $orderDataDepartment = '';
    $orderDataMunicipe = '';
    $orderDataNameFact = '';
    $orderDataNitFact = '';
    $orderDataDirectionFact = '';
    $orderDataSituation = '';
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
    $ClsDetailOrderData = new orderDetailData();
    
    $resultDetailData = $ClsDetailOrderData->get( '', $orderId );
    while( $orderDetailData = $resultDetailData->fetch_object() ){
        $orderDataId = trim( $orderDetailData->ordt_id  );
        $orderDataOrder = trim( $orderDetailData->ordt_order  );
        $orderDataName = trim( $orderDetailData->ordt_name );
        $orderDataSurname = trim( $orderDetailData->ordt_surname );
        $orderDataPhone = trim( $orderDetailData->ordt_phone );
        $orderDataMail = trim( $orderDetailData->ordt_mail );
        $orderDataDirection = trim( $orderDetailData->ordt_direction );
        $orderDataDepartment = trim( $orderDetailData->ordt_department );
        $orderDataMunicipe = trim( $orderDetailData->ordt_municipe );
        $orderDataNameFact = trim( $orderDetailData->ordt_name_fact );
        $orderDataNitFact = trim( $orderDetailData->ordt_nit_fact );
        $orderDataDirectionFact = trim( $orderDetailData->ordt_direction_fact );
        $orderDataSituation = trim( $orderDetailData->ordt_situation );

    }
}

///MAKE CONSULT DETAILS ORDER
$ClsOrder = new order();
$ClsDetailOrder = new orderDetail();
$ClsDetailOrderData = new orderDetailData();


// $validateStepOne = $ClsDetailOrder->get( '', $orderId )->num_rows;
// $validateStepTwo = $ClsDetailOrderData->get( '', $orderId )->num_rows;
// $validateStepThree = $ClsOrder->get( $orderId, 1 )->num_rows;



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
                    <h2 class="title t-underline">Visualizaci&oacute;n de Pedido No. <?= $orderId ?></h2>

                    <div class="item-main-content">
                        <h3>Datos Personales</h3>
                        <div class="flex-items">
                            <label for="">Nombre: </label>
                            <input placeholder="Ingrese Nombre" class="input" type="text" id="name" name="name" value="<?= $orderDataName ?>">
                            <label for="">Apellido: </label>
                            <input placeholder="Ingrese Apellido" class="input" type="text" id="surname" name="surname" value="<?= $orderDataSurname ?>">
                        </div>
                        <div class="flex-items">
                            <label for="">Telefono: </label>
                            <input placeholder="0000-0000" class="input" type="text" id="phone" name="phone" value="<?= $orderDataPhone ?>">
                            <label for="">Correo Electronico: </label>
                            <input placeholder="mail@gmail.com" class="input" type="text" id="mail" name="mail" value="<?= $orderDataMail ?>">
                        </div>
                        
                    </div>
                    <div class="item-main-content">
                        <h3>Datos para la Entrega</h3>
                        <div class="flex-items no-center single">
                            <label>Direccion de Entrega: </label>
                            <textarea class="input" name="direction" id="direction" cols="10" rows="5"><?= $orderDataDirection ?></textarea>
                        </div>

                        <div class="flex-items">
                            <label for="">Departamento: </label>
                            <input class="input"  type="text" id="department" name="department" value="<?= $orderDataDepartment ?>">
                            <label for="">Municipio: </label>
                            <input class="input"  type="text" id="municipe" name="municipe" value="<?= $orderDataMunicipe ?>">
                        </div>
                    </div>
                    <div class="item-main-content">
                    <h3>Datos Para la Factura</h3>
                        <div class="flex-items">
                            <label for="">Nombre </label>
                            <input placeholder="Ingrese Nombre" class="input" type="text" id="nameFactur" name="nameFactur" value="<?= $orderDataNameFact ?>">
                            <label for="">Nit </label>
                            <input placeholder="0000000-0" class="input" type="text" id="nit" name="nit" value="<?= $orderDataNitFact ?>">
                        </div>
                        <div class="flex-items no-center single">
                            <label for="">Direccion</label>
                            <textarea class="input" name="directionFact" id="directionFact" cols="10" rows="5"><?= $orderDataDirectionFact ?></textarea>
                        </div>
                    </div>
                    <div class="list-panel">                
                        <ul id="container-items-car-shop">
                            <?php
                            $levelFile = '../../';
                            $ClsPro = new product();
                            $ClsOrderDetail = new orderDetail();
                            $products = $ClsOrderDetail->get( '', $orderId );
                           // var_dump( $products );die();
                            $arrData = array();

                            while( $product = $products->fetch_object() ):

                                $productId = $product->pro_id;
                                $productCategory = $product->pro_category;
                                $productSubcategory = $product->pro_subcategory;
                                $productName = $product->pro_name;
                                $productDescription = $product->pro_description;
                                $productStock = $product->pro_stock;
                                $productPrice = $product->pro_price;
                                $productSituation = $product->pro_situation;
                                $productQuantityByOrder = $product->proord_quantity;

                     
                                 //get image
                                 $imageProduct = $ClsPro->get_image_product( '', $productId, '', '', 1, true );
                     
                                 if( $imageProduct ){
                                     
                                     while ( $image = $imageProduct->fetch_object() ){
                                         $imagePicture = $image->pic_image;
                                     }
                                     
                                     if( $imagePicture != '' ){
                                         $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $imagePicture;
                                         if( file_exists('../../SYSTEM/IMAGES/PRODUCT/' . $imagePicture ) ){   
                                             $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $imagePicture;
                                         }else{
                                             $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
                                         }
                                     }else{
                                         $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
                                     }
                     
                                 }else{
                                         
                                     $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
                         
                                 }?>
                     
                                 <li>
                                 <div class="li-panel-img">
                                     <img src="<?= $picture ?>" alt="" srcset="">
                                 </div>
                                 <div class="li-panel-content">
                                     <input type="hidden" value="4" class="codeProductCar">
                                     <a title="Ir al Producto" target="_blank" href="http://localhost/commerce/PAGE/PAGES/view-product.php?code=<?= $productId ?>">
                                         <h4><?= $productName?></h4>
                                     </a>
                                     <h5><?= $productPrice ?></h5>
                                     <div class="btn-count">
                                         <input type="number" class="quantity" disabled="" value="<?= $productQuantityByOrder ?>" placeholder="1">
                                     </div>
                                 </div>
                             </li>
                                
                     
                     
                            <?php endwhile
                            //  var_dump( $arrData );die();
                            ?>
                           
                        </ul>                
                        <h4 class="total">Total: </h4>
                        <h5 class="total mr-1" id="total" >$. <?= $orderTotal ?> </h5>
                    </div>
                </div>
            </div>
        

            
        </div>
        
    </section>
    <!-- end section -->
    <?= footer( '../' ); ?>
    <?= script_js( '../', false ); ?>
    <script src="../ASSETS.V_01/js/scripts_modules/user/user.js"></script>


</body>
</html>