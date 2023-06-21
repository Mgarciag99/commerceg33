<?php
    session_start();

    require_once( 'CLASSES/clsCategory.php' );
    require_once( 'CLASSES/clsSubCategory.php' );
    require_once( 'CLASSES/clsProduct.php' );
    require_once( 'CLASSES/ClsUser.php' );
    require_once( 'CLASSES/ClsOrder.php' );
    require_once( 'CLASSES/ClsDetailOrder.php' );
    require_once( 'CLASSES/ClsDetailOrderData.php' );


    function validate_login(){
        if( !isset( $_SESSION[ 'codeUser' ] ) ){
            echo "<form id='f1' name='f1' action='../logout.php' method='post'>";
            echo "<script>document.f1.submit();</script>";
            echo "</form>";
        }


    }



         



?>