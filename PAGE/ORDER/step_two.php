<?php

require_once('module_order.php');
validate_login();

$ClsOrder = new order();
$result = $ClsOrder->get('', 1, '', '', $_SESSION['codeUser'], '', 1);

// var_dump( $result );die;

if ($result->num_rows != 0) {
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
    while ($order = $result->fetch_object()) {
        $orderId = trim($order->ord_id);
        $orderStatus = trim($order->ord_status);
        $orderDate = trim($order->ord_date);
        $orderTotal = trim($order->ord_total);
        $orderUser = trim($order->ord_usuario);
        $orderDirection = trim($order->ord_direction);
        $orderSituation = trim($order->ord_situation);
    }
    $ordenNo = $orderId;
    $ClsDetailOrderData = new orderDetailData();

    $resultDetailData = $ClsDetailOrderData->get('', $orderId);
    while ($orderDetailData = $resultDetailData->fetch_object()) {
        $orderDataId = trim($orderDetailData->ordt_id);
        $orderDataOrder = trim($orderDetailData->ordt_order);
        $orderDataName = trim($orderDetailData->ordt_name);
        $orderDataSurname = trim($orderDetailData->ordt_surname);
        $orderDataPhone = trim($orderDetailData->ordt_phone);
        $orderDataMail = trim($orderDetailData->ordt_mail);
        $orderDataDirection = trim($orderDetailData->ordt_direction);
        $orderDataDepartment = trim($orderDetailData->ordt_department);
        $orderDataMunicipe = trim($orderDetailData->ordt_municipe);
        $orderDataNameFact = trim($orderDetailData->ordt_name_fact);
        $orderDataNitFact = trim($orderDetailData->ordt_nit_fact);
        $orderDataDirectionFact = trim($orderDetailData->ordt_direction_fact);
        $orderDataSituation = trim($orderDetailData->ordt_situation);
    }
}

///MAKE CONSULT DETAILS ORDER
$ClsOrder = new order();
$ClsDetailOrder = new orderDetail();
$ClsDetailOrderData = new orderDetailData();

$validateStepOne = $ClsDetailOrder->get('', $orderId)->num_rows;
$validateStepTwo = $ClsDetailOrderData->get('', $orderId)->num_rows;
$validateStepThree = $ClsOrder->get($orderId, 1)->num_rows;

// var_dump( $validateStepTwo );die();

?>
<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?= head('../'); ?>
<link rel="stylesheet" href="../ASSETS.V_01/css/style-managment.css">
<link rel="stylesheet" href="../ASSETS.V_01/css/style-steps-order.css">
<link rel="stylesheet" href="../ASSETS.V_01/css/validations/validations.css">


<body>

    <!-- modal -->
    <?= login_frm(); ?>
    <!-- end modal -->

    <!-- navbar -->
    <?= navbar('../') ?>

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
                    <h2 class="title">Orden No. <?= $ordenNo ?></h2>
                    <div class="main-sidebar-header">
                        <div>
                            <label>Hola</label>
                            <h2><?= strtoupper($_SESSION['user']) ?></h2>
                            <label>marcopc303@gmail.com</label>
                        </div>
                        <div>
                            <img width="100%" src="../ASSETS.V_01/img/images.jpg" alt="">
                        </div>
                    </div>
                    <div class="main-section">
                        <ul>
                            <?= sidebar_order(2); ?>
                        </ul>
                    </div>
                    <button style="margin-bottom: 1em;" class="button-item" onclick="window.history.back();"><i class="fas fa-arrow-circle-left"></i> Regresar</button>

                    <?= button_close_session(); ?>
                </div>
                <div class="main-content">
                    <h2 class="title t-underline">Solicitud de Datos</h2>
                    <input type="hidden" id="validateStepOne" value="<?= $validateStepOne ?>">
                    <input type="hidden" id="validateStepTwo" value="<?= $validateStepTwo ?>">
                    <input type="hidden" id="validateStepThree" value="<?= $validateStepThree ?>">
                    <form id="form" name="form" method="post" enctype="multipart/form-data">

                        <div class="item-main-content">
                            <h3>Datos Personales</h3>
                            <div class="flex-items">
                                <label for="">Nombre: </label>
                                <input required placeholder="Ingrese Nombre" class="input" type="text" id="name" name="name" value="<?= $orderDataName ?>">
                                <label for="">Apellido: </label>
                                <input required placeholder="Ingrese Apellido" class="input" type="text" id="surname" name="surname" value="<?= $orderDataSurname ?>">
                            </div>
                            <div class="flex-items">
                                <label for="">Telefono: </label>
                                <input required placeholder="0000-0000" class="input" type="text" id="phone" name="phone" value="<?= $orderDataPhone ?>">
                                <label for="">Correo Electronico: </label>
                                <input required placeholder="mail@gmail.com" class="input" type="text" id="mail" name="mail" value="<?= $orderDataMail ?>">
                            </div>

                        </div>
                        <div class="item-main-content">
                            <h3>Datos para la Entrega</h3>
                            <div class="flex-items no-center single">
                                <label>Direccion de Entrega: </label>
                                <textarea required class="input" name="direction" id="direction" cols="10" rows="5"><?= $orderDataDirection ?></textarea>
                            </div>

                            <div class="flex-items">
                                <label for="">Departamento: </label>
                                <input required class="input" type="text" id="department" name="department" value="<?= $orderDataDepartment ?>">
                                <label for="">Municipio: </label>
                                <input required class="input" type="text" id="municipe" name="municipe" value="<?= $orderDataMunicipe ?>">
                            </div>
                        </div>
                        <div class="item-main-content">
                            <h3>Datos Para la Factura</h3>
                            <div class="flex-items">
                                <label for="">Nombre </label>
                                <input required placeholder="Ingrese Nombre" class="input" type="text" id="nameFactur" name="nameFactur" value="<?= $orderDataNameFact ?>">
                                <label for="">Nit </label>
                                <input required placeholder="0000000-0" class="input" type="text" id="nit" name="nit" value="<?= $orderDataNitFact ?>">
                            </div>
                            <div class="flex-items no-center single">
                                <label for="">Direccion</label>
                                <textarea required class="input" name="directionFact" id="directionFact" cols="10" rows="5"><?= $orderDataDirectionFact ?></textarea>
                            </div>
                        </div>
                    </form>
                    <button class="button-item button-medium" onclick="addDetailDataToOrder();"><i class="fas fa-save"></i> <i class="fas fa-user icon-button"></i> Guardar Datos</button>
                </div>
            </div>

        </div>

    </section>
    <!-- end section -->
    <?= footer('../'); ?>
    <?= script_js('../'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="../ASSETS.V_01/js/scripts_modules/user/user.js"></script>
    <script src="../ASSETS.V_01/js/scripts_modules/order/order.js"></script>
    <script>
        window.addEventListener('load', () => {
            addAlerts();
        })
    </script>

</body>

</html>