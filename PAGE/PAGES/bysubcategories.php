<?php 
require_once( 'module_pages.php' );
require_once( '../API/module_apis.php' );
$ClsSubCat = new subcategory();
$code = $_REQUEST[ 'code' ];
$codeCategory = $_REQUEST[ 'codeCategory' ];


$result = $ClsSubCat->get( $code, '', '', '',  1 );

while( $subcategory = $result->fetch_object() ){
    //table category
    $subCategoryId = $subcategory->subcat_id ;
    $subCategoryName = utf8_decode( $subcategory->subcat_name );  
    $subCategoryDescription = utf8_decode( $subcategory->subcat_description );  
    $subCategorySituation = $subcategory->subcat_situation;  
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

    <!-- categories panel -->
    <?= panel_categories() ?>
    <?= panel_subcategories() ?>

    <!-- categories panel -->
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
                    <h1 class="title" style="text-align: center;"><?= $subCategoryName ?></h1>
                </div>
                <div class="container">
                    <p> <?= $subCategoryDescription ?> </p>
                </div>

                <div class="space"></div>            
            </div>
        </div>
        <!-- <div class="space"></div> -->
        <div id="main-two">
            <div class="container">
                <h1 class="title"> Productos </h1>
                <input type="hidden" id="category" name="category" value="<?= $code ?>">
                <input type="hidden" id="subcategory" name="subcategory" value="<?= $codeCategory?>">

                
            </div>
            <div class="bg-container-gray pd-tb-3">
                <div id="container-second" class="container">
                <?php //echo products( '', $code, '', '', '', '', '', 1, '../../' );?>
                </div>
            </div>
            
        </div>
        <!-- <div id="main-three">
            <div class="container">
                <h2>Acerca de</h2>
                <p>Párrafo. Haz clic aquí para agregar tu propio texto y editar. Es fácil. Haz clic en "Editar Texto" o doble clic aquí para agregar tu contenido y cambiar la fuente. En este espacio puedes contar tu historia y permitir a tus usuarios saber más sobre ti</p>
            </div>
        </div> -->

        
    </section>
    <!-- end section -->
    <?= footer( '../' ); ?>
    <?= script_js( '../' ); ?>
    <!-- <script src="../ASSETS.V_01/js/scripts_modules/category/subcategory.js"></script> -->
    <script src="../ASSETS.V_01/js/scripts_modules/product/product-js.js"></script>


</body>
</html>