<?php
    require_once( '../module_category.php' );
    $ClsCat = new category();
    $codeImage = $_REQUEST[ 'codeImage' ];
    $category = $_REQUEST[ 'category' ];
    $type = $_REQUEST[ 'type' ];
    $codeCategory = $_REQUEST[ 'codeCategory' ];

    $result = $ClsCat->get_image_category( $codeImage, $category, '', $type );
    $image = $result->fetch_object()->pic_image;
?>
<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?= head( '../../' ); ?>
    <link href="../../ASSETS.V_01/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?= navbar( '../../' )?>
            <!-- sidebar -->
            <?= sidebar( '' )?>

            <!-- content-page -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Edicion de Foto</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Mantenimiento de Categorias
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-xs-12">
                                            <div class="image-crop">
                                                <img src="../../IMAGES/CATEGORY/<?= $image ?>">
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-xs-12">
                                            <h4>Vista Previa</h4>
                                            <input type="hidden" id="category" name="category" value="<?= $category?>">
                                            <input type="hidden" id="codeImage" name="codeImage" value="<?= $codeImage?>">
                                            <input type="hidden" id="type" name="type" value="<?= $type?>">
                                            <input type="hidden" id="codeCategory" name="codeCategory" value="<?= $codeCategory?>">


                                            <div style="overflow: hidden; width: 400px; heigth: 400px;"class="img-preview img-preview"></div>
                                            <br>
                                            <div class="btn-group">
                                                <label title="Donwload image" id="download" class="btn btn-primary btn-block">
                                                    <i class="fa fa-save"></i> &nbsp; 
                                                    Guardar Imagen
                                                </label>
                                            </div>
                                            <hr>
                                            <h4><i class="fa fa-wrench"></i>  Herramientas de Edici&oacute;n</h4>
                                            <br>
                                            <div class="btn-group">
                                                <button class="btn btn-default" id="zoomIn" type="button"><i class="fa fa-search-plus"></i> Zoom</button>
                                                <button class="btn btn-default" id="zoomOut" type="button"><i class="fa fa-search-minus"></i> Zoom</button>
                                                <button class="btn btn-default" id="rotateLeft" type="button"><i class="fa fa-rotate-left"></i> Rotar a la Izquierda</button>
                                                <button class="btn btn-default" id="rotateRight" type="button"><i class="fa fa-rotate-right"></i> Rotar a la Derecha</button>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <!-- content-page -->
        </div>
        <!-- /#wrapper -->
        <?= script_js( '../../' ); ?>
        <!-- Image cropper -->
        <script src="../../ASSETS.V_01/js/plugins/cropper/cropper.min.js"></script>
        <script src="../../ASSETS.V_01/scripts_modules/category/picture.js"></script>
        <script>
            window.addEventListener( 'load', ()=>{
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            } );
        </script>
    </body>
</html>
