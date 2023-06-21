<?php 
    require_once( 'module_pages.php' );
    $code = $_REQUEST[ 'code' ];
    $ClsProduct = new product();

    $result = $ClsProduct->get( $code );
 //   var_dump( $result ); die();
    while( $product = $result->fetch_object() ){
        //table category
        $productId = $product->pro_id;
        $productCategory = trim( $product->pro_category  );  
        $productSubcategory = trim( $product->pro_subcategory );  
        $productName = utf8_decode( $product->pro_name );  
        $productDescription = utf8_decode( $product->pro_description );  
        $productStock = $product->pro_stock;  
        $productPrice = $product->pro_price;  
        $productSituation = $product->pro_situation;  

    }
?>
<!DOCTYPE html>
<html lang="en">
    <?= head( '../' ); ?>
    <style>
        #main-two{
            background-color: #fff;
        }
    </style>
    <link rel="stylesheet" href="../ASSETS.V_01/css/style-carrousel.css">
<body>
   
    <!-- modal -->
    <?= login_frm(); ?>
    <!-- end modal -->
    
    <!-- car shopping panel -->
    <?= shopping_cart_panel();?>
    <!-- end car shopping panel -->
    
    <!-- categories panel -->
    <?= panel_categories() ?>
    <?= panel_subcategories() ?>

    <!-- categories panel -->

    <!-- navbar -->
     <?= navbar( '../' )?>
    <!-- end navbar -->
    <div class="space"></div>
    <div class="space"></div>
    <div class="space"></div>


     <!-- shopping cart-->
     <?= shopping_cart(); ?>
    <!-- end cart-->

    <!-- section -->
    <section>
        <input type="hidden" name="code" id="code" value="<?= $code ?>">
        <div id="main-two">
            <div class="row">
                <div class="column">
                    <div class="carrousel-arrows-cards">
                        <button id="arrow-left"><i class="fas fa-chevron-left"></i></button>
                        <button id="arrow-right"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
                <div class="column">
                    <input type="hidden" name="codeProduct" id="codeProduct" value="<?= $productId ?>">
                    <h1> <?= $productName?> </h1>
                    <h2>$. <?= $productPrice ?></h2>
                    <label for="">Cantidad: </label>
                    <input id="quantity" type="number" value="1" class="input">
                    <?php if( $productStock == 0 ): ?>
                        <button class="button-item button-item-second">Producto Agotado</button>
                    <?php else: ?>
                        <button class="button-item button-item-second" onclick="addToCarrShop()">Agregar al Carrito</button>
                    <?php endif; ?>

                    <button class="button-item" >Realizar Compra</button>
                    <h3>INFORMACION DEL PRODUCTO</h3>
                    <p> <?= $productDescription ?></p>
                </div>
            </div>
        </div>


        <div id="main-two">
            <div class="container">
        
                <h1 class="title"> Tambien te puede interesar </h1>
                <input type="hidden" id="category" name="category" value="">
                <input type="hidden" id="subcategory" name="subcategory" value="">
            </div>
            <div class="bg-container-gray pd-tb-3">
                <div id="container-second" class="container">
                <?php //echo products( '', $code, '', '', '', '', '', 1, '../../' );?>
                </div>
            </div>
            

            <div id="charge" class="bg-container-gray">
            </div>
        </div>


    </section>
    <!-- end section -->
    <!-- end section -->
    <?= footer( '../' ); ?>
    <?= script_js( '../' ); ?>
    <script src="../ASSETS.V_01/js/scripts_modules/product/product-carrousel.js"></script>
    <script src="../ASSETS.V_01/js/scripts_modules/product/product-js.js"></script>
    
</body>
</html>