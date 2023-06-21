<?php
    require_once( '../module_category.php' );
    
    $code = $_REQUEST[ 'category' ];
    $ClsCategory = new category();
    $result = $ClsCategory->get( $code );
   //var_dump( $result->fetch_object() );die();

    while( $category = $result->fetch_object() ){
        $nameCategory = utf8_decode( $category->cat_name );
    }
?>
<!DOCTYPE html>
<html lang="en">
    <!-- head -->
    <?= head( '../../' ); ?>
    <link rel="stylesheet" href="../../ASSETS.V_01/css/plugins/modal.css">
    
    <body>
        <!-- modal -->
        <div class="overlay">
            <a id="close" onclick="openModal();"><i class="fa fas fa-times"></i></a>
            
            <div id="modal">
                
                
            </div>
        </div>
        <!-- end modal -->
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
                            <h1 class="page-header">Gestion sub-categorias</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Mantenimiento de sub-categorias
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6 text-left">
                                            <a class="btn btn-white" href="management_category.php">
                                                <i class="fa fa-chevron-left" aria-hidden="true"></i> Atrás
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form id="form" name="form" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="control-label" for="inputSuccess">Categoria</label>
                                                    <input type="text" class="form-control disabled" disabled value=<?= $nameCategory ?>>
                                                    <input type="hidden" id="codeCategory" value="<?=$code?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="inputSuccess">Nombre</label>
                                                    <input type="text" class="form-control" id="name" name="name">
                                                    <input type="hidden" id="codeSubcategory">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label" for="inputWarning">Descripcion</label>
                                                    <input type="text" class="form-control" id="description" name="description">
                                                </div>
                                                <input id="image" name="image" type="file" multiple="false" class="hidden" onchange="chargeImage();">

                                            </form>
                                            <button id="save" onclick="save();" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
                                            <button id="update" onclick="update();" class="btn btn-success hidden"><i class="fa fa-floppy-o" aria-hidden="true"></i> Actualizar</button>
                                            <button id="" onclick="location.reload();" class="btn btn-white"><i class="fa fa-floppy-o" aria-hidden="true"></i> Limpiar</button>
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div id="container-table">
                                            </div>
                                        </div>
                                    </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
        <script src="../../ASSETS.V_01/js/plugins/modal.js"></script>
        <script src="../../ASSETS.V_01/scripts_modules/category/sub_category.js"></script>
        <script>
            window.addEventListener( 'load', ()=>{
                table();
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            } );
        </script>
    </body>
</html>
