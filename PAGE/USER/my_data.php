<?php 
require_once( 'module_user.php' );

validate_login();

$ClsUse = new user();
$result = $ClsUse->get( $_SESSION['codeUser'] );
if( $result->num_rows !== 0 ){
    while ( $user = $result->fetch_object() ){
        $usu_id = $user->usu_id;
        $usu_name = utf8_decode( $user->usu_name );
        $usu_surname = utf8_decode( $user->usu_surname );
        $usu_user = $user->usu_user;
        $usu_mail = $user->usu_mail;
        $usu_password = $user->usu_password;
        $usu_rol = $user->usu_rol;
        $usu_date_register = $user->usu_date_register;
        $usu_situation = $user->usu_situation;
    }
}
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
                            <?= sidebar_user( 2 )?>
                        </ul>
                    </div>
                    <button style = "margin-bottom: 1em;"class="button-item" onclick="window.history.back();"><i class="fas fa-arrow-circle-left"></i> Regresar</button>

                    <?= button_close_session(); ?>
                </div>
                <div class="main-content">
                    <h2 class="title">Mis Datos</h2>

                    <div class="item-main-content">
                        <h3>Datos Personales</h3>
                        <div class="flex-items">
                            <label for="">Nombre: </label>
                            <input type="hidden" id="code" name="code" value="<?= $_SESSION['codeUser'] ?>">
                            <input placeholder="Nombre" class="input" type="text" id="name" name="name" value="<?= $usu_name ?>">
                            <label for="">Apellido: </label>
                            <input placeholder="Apellido" class="input" type="text" id="surname" name="surname" value="<?= $usu_surname ?>">
                        </div>
                        <div class="flex-items">
                            <label for="">Password: </label>
                            <input placeholder="" class="input" type="password" id="password" name="password" value="<?= $usu_password ?>">
                            <label for="">Correo Electronico: </label>
                            <input placeholder="mail@gmail.com" class="input" type="text" id="mail" name="mail" value="<?= $usu_mail ?>">
                        </div>
                        <button class="button-item button-medium" onclick="updateDataUser();"> Actualizar</button>

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