<?php 
require_once( 'module_pages.php' );
require_once( '../API/module_apis.php' );
$ClsCat = new category();
$code = $_REQUEST[ 'code' ];

$result = $ClsCat->get( $code, '', '', 1 );

while( $category = $result->fetch_object() ){
    //table category
    $categoryId = $category->cat_id;
    $categoryName = utf8_decode( $category->cat_name );  
    $categoryDescription = utf8_decode( $category->cat_description );  
    $categorySituation = $category->cat_situacion;  
}
?>
<!DOCTYPE html>
<html lang="en">
    <?= head( '../' ); ?>
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
    
    <!-- section -->
    <section>
        <div id="main-one">
            <div>
                <div class="container">
                    <h1 class="title" style="text-align: center;"><?= $categoryName ?></h1>
                </div>
                <div class="container">
                    <p> <?= $categoryDescription ?> </p>
                </div>

                <div class="space"></div>
                    <input type="hidden" name="codeCategory" id="codeCategory" value="<?= $categoryId ?>">
                    
                    <div class="main-one-content">
                        <?php //carrousel_subcategories( $categoryId, '', '', '', 2,  1, '../../' ) ?>
                        <div class="carrousel-arrows-cards">
                            <button id="arrow-left"><i class="fas fa-chevron-left"></i></button>
                            <button id="arrow-right"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
            </div>
        </div>
        <div class="space"></div>
        <div id="main-two">
            <div class="container">
                <h1 class="title"> Productos </h1>
                <input type="hidden" id="category" name="category" value="<?= $code ?>">
                <input type="hidden" id="subcategory" name="subcategory" value="">

                
            </div>
            <div id="container-second" class="container">

                <?php //echo products( '', $code, '', '', '', '', '', 1, '../../' );?>
            </div>

            <div id="charge">
            </div>
            
        </div>
        <div id="main-three">
            <div class="container">
                <h2>Acerca de</h2>
                <p>Párrafo. Haz clic aquí para agregar tu propio texto y editar. Es fácil. Haz clic en "Editar Texto" o doble clic aquí para agregar tu contenido y cambiar la fuente. En este espacio puedes contar tu historia y permitir a tus usuarios saber más sobre ti</p>
            </div>
        </div>

        
    </section>
    <!-- end section -->
    <?= footer( '../' ); ?>
    <?= script_js( '../' ); ?>
    <script src="../ASSETS.V_01/js/scripts_modules/category/subcategory.js"></script>
    <script src="../ASSETS.V_01/js/scripts_modules/product/product-js.js"></script>


</body>
</html>