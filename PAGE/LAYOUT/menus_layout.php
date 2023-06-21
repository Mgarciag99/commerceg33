<?php
    function head( $level = '' ){
    
        $output = '';
        $output.= '<head>';
        $output.= '    <meta charset="UTF-8">';
        $output.= '    <meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $output.= '    <meta name="viewport" content="width=device-width, initial-scale=1.0">';
        $output.= '    <title>Document</title>';
        $output.= '    <script src="https://kit.fontawesome.com/f38b76288b.js" crossorigin="anonymous"></script>';
        $output.= '    <!-- Sweet Alert -->';
        $output.= '    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        $output.= '    <link rel="stylesheet" href="' . $level . 'ASSETS.V_01/css/style.css">';
        $output.= '</head>';

        return $output;
    
    }

    function navbar( $level = '' ){
        $domain = $_SERVER['HTTP_HOST'];
        $output = '';
        $output.= '<nav id="nav" class="scroll-nav">';
        $output.= '    <div class="container-nav">';
        $output.= '        <div class="item-nav">';
        if( isset( $_SESSION[ 'codeUser' ] ) ){
            $output.= '            <a class="button-navbar" href="http://' . $domain . '/commerce/PAGE/USER/myaccount.php" title="Mi Cuenta"> <i class="fas fa-user icon-button"></i> ' . $_SESSION[ 'user' ] . ' </a>';
        }else{
            $output.= '            <a class="button-navbar" onclick="openModal();" > <i class="fas fa-user icon-button"></i>  Iniciar Sesion</a>';
        }
        $output.= '        </div>';
        $output.= '        <div class="item-nav">';
        // $output.= '            <ul>';
        // $output.= '                <a href="#"><li>Acerca de Nosotros</li></a>';
        $output.= '             <div id="container-search">';
        $output.= '                 <div class="input-search">';
        $output.= '                     <input type="text" placeholder="Que estas Buscando?" onkeyup="search( this.value );">';
        $output.= '                     <div>';
        $output.= '                     <i class="fas fa-search" aria-hidden="true"></i>';
        $output.= '                     </div>';
        $output.= '                  </div>';
        // $output.= '             </div>';
        $output.= '             <ul id="result-search">';
        $output.= '             </ul>';
        
        $output.= '             </div>';
        // $output.= '            </ul>';
        $output.= '        </div>';

        $output.= '        <div class="item-nav">';
        $output.= '            <a class="button-navbar" href="http://' . $domain . '/commerce/PAGE/PAGES"><i class="fas fa-home"></i>   Inicio</a>';
        $output.= '            <a class="button-navbar" href="#"><i class="fas fa-phone-alt"></i> Contactanos</a>';
        $output.= '            <a class="button-navbar" title="Categorias" onclick="list_categories()"> <i class="fas fa-bars"></i>   Categorias</a>';
        // $output.= '            <a id="logo" href="http://' . $domain . '/commerce/PAGE/PAGES"><h1>Tienda En Linea</h1></a>';
        // $output.= '            <span id="slogan">La mejor ropa del pais</span>';
        $output.= '        </div>';

        $output.= '    </div>';
        $output.= '</nav>';
    
        return $output;

    }

    function sidebar( $level = '' ){
        $domain = $_SERVER['HTTP_HOST'];
        $output = '';
        $output.= '    <div class="navbar-default sidebar" role="navigation">';
        $output.= '        <div class="sidebar-nav navbar-collapse">';
        $output.= '            <ul class="nav" id="side-menu">';
        $output.= '                <li class="sidebar-search">';
        $output.= '                    <div class="input-group custom-search-form">';
        $output.= '                        <input type="text" class="form-control" placeholder="Search...">';
        $output.= '                        <span class="input-group-btn">';
        $output.= '                            <button class="btn btn-primary" type="button">';
        $output.= '                                <i class="fa fa-search"></i>';
        $output.= '                            </button>';
        $output.= '                    </span>';
        $output.= '                    </div>';
        $output.= '                </li>';
        $output.= '                <li>';
        $output.= '                    <a href="http://' . $domain . '/commerce/SYSTEM/FLCATEGORY/FRM/management_category.php" class=""><i class="fa fa-dashboard fa-fw"></i> Gestion Categorias</a>';
        $output.= '                </li>';
        $output.= '                <li>';
        $output.= '                    <a href="http://' . $domain . '/commerce/SYSTEM/FLPRODUCT/FRM/management_product.php" class=""><i class="fa fa-dashboard fa-fw"></i> Gestion Productos</a>';
        $output.= '                </li>';
        $output.= '            </ul>';
        $output.= '        </div>';
        $output.= '    </div>';
        
        return $output;

    }

    function footer( $level = '' ){
        $output = '';
        $output.= '<footer>';
        $output.= '    <div class="footer-one">';
        $output.= '        <a href="">Click aca para ver todos los productos</a>';
        $output.= '    </div>';
        $output.= '    <div class="container-footer">';
        $output.= '        <div class="footer-two">';
        $output.= '            <div class="form">';
        $output.= '                <form action="">';
        $output.= '                    <input type="text" name="" id="" placeholder="Nombre">';
        $output.= '                    <input type="text" name="" id="" placeholder="mail@email.com">';
        $output.= '                    <input type="text" name="" id="" placeholder="Apellido">';
        $output.= '                    <textarea name="" id="" cols="5" rows="5">Mensaje..</textarea>';
        $output.= '                    <button>Enviar</button>';
        $output.= '                </form>';
        $output.= '            </div>';
        $output.= '            <div class="content">';
        $output.= '                <h2>Contacto</h2>';
        $output.= '                <p>';
        $output.= '                    info info info info info info info info info info info info info info info info ';
        $output.= '                    usuarios saber mas sobre ti';
        $output.= '                    <a href="">marcopc303@gmail.com</a>';
        $output.= '                    <a href="">21212121</a>';
        $output.= '                </p>';
        $output.= '                <div class="footer-links" >';
        $output.= '                 <a href="#" class="link-footer"><i class="fab fa-facebook"></i></a>';
        $output.= '                 <a href="#" class="link-footer"><i class="fab fa-twitter"></i></a>';
        $output.= '                 <a href="#" class="link-footer"><i class="fab fa-instagram"></i></a>';
        $output.= '                </div>';

        $output.= '            </div>';
        $output.= '        </div>';
        $output.= '    </div>';
        $output.= '    <div class="footer-three">Development by Marco Quinti 2023</div>';
        $output.= '</footer>';
        return $output;
    }
    function script_js( $level = '', $carshop = true ){
        
        $output = '';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/carrousel-nav.js"></script>';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/scroll.js"></script>';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/modal.js"></script>';
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/utils.js"></script>';
        if( $carshop ){
            $output.= '<script src="' . $level . 'ASSETS.V_01/js/scripts_modules/product/car-shop.js"></script>';   
        }
        $output.= '<script src="' . $level . 'ASSETS.V_01/js/scripts_modules/product/search-product.js"></script>';   

        $output.= '<script src="' . $level . 'ASSETS.V_01/js/scripts_modules/category/category.js"></script>';   



        return $output;

    }

    function shopping_cart( $level = '' ){

        $output = '';
        $output.= '<div class="btn-fixed">';
        $output.= '    <span class="badge badge-danger">';
        $output.= '        <span id="count-items">0</span>';
        $output.= '    </span>';
        $output.= '    <button onclick="view_shopping_cart();viewCarrShop();"><i class="fas fa-shopping-cart"></i></button>';
        $output.= '</div>';
        return $output;
    
    }

    function shopping_cart_panel( $level = '' ){

        $output = '';
        $output.= '<div class="overlay-panel">';
        $output.= '    <div id="panel">';
        $output.= '        <button id="close-panel" onclick="view_shopping_cart();"><i class="fa fas fa-times"></i></button>';
        $output.= '        <div class="head-panel center-c">';
        $output.= '            <h3>Carrito</h3>';
        $output.= '        </div>';
        $output.= '        <div class="content-panel">';
        $output.= '            <div class="list-panel">';
        $output.= '                <ul id="container-items-car-shop">';

        // $output.= '                    <li>';
        // $output.= '                        <div class="li-panel-img">';
        // $output.= '                            <img src="assets/img/descarga (1).jpg" alt="" srcset="">';
        // $output.= '                        </div>';
        // $output.= '                        <div class="li-panel-content">';
        // $output.= '                            <h4>Soy un producto</h4>';
        // $output.= '                            <h5>$. 10.00 </h5>';
        // $output.= '                            <div class="btn-count">';
        // $output.= '                                <button class="btn-minus"> <i class="fa fa-solid fa-plus"></i> </button>';
        // $output.= '                                <h6>7</h6>';
        // $output.= '                                <button class="btn-more"> <i class="fa fa-solid fa-minus"></i> </button>';
        // $output.= '                            </div>';
        // $output.= '                        </div>';
        // $output.= '                    </li>';
        // $output.= '                    <li>';
        // $output.= '                        <div class="li-panel-img">';
        // $output.= '                            <img src="assets/img/descarga (1).jpg" alt="" srcset="">';
        // $output.= '                        </div>';
        // $output.= '                        <div class="li-panel-content">';
        // $output.= '                            <h4>Soy un producto</h4>';
        // $output.= '                            <h5>$. 10.00 </h5>';
        // $output.= '                            <div class="btn-count">';
        // $output.= '                                <button class="btn-minus"> <i class="fa fa-solid fa-plus"></i> </button>';
        // $output.= '                                <h6>7</h6>';
        // $output.= '                                <button class="btn-more"> <i class="fa fa-solid fa-minus"></i> </button>';
        // $output.= '                            </div>';
        // $output.= '                        </div>';
        // $output.= '                    </li>';
        // $output.= '                    <li>';
        // $output.= '                        <div class="li-panel-img">';
        // $output.= '                            <img src="assets/img/descarga (1).jpg" alt="" srcset="">';
        // $output.= '                        </div>';
        // $output.= '                        <div class="li-panel-content">';
        // $output.= '                            <h4>Soy un producto</h4>';
        // $output.= '                            <h5>$. 10.00 </h5>';
        // $output.= '                            <div class="btn-count">';
        // $output.= '                                <button class="btn-minus"> <i class="fa fa-solid fa-plus"></i> </button>';
        // $output.= '                                <h6>7</h6>';
        // $output.= '                                <button class="btn-more"> <i class="fa fa-solid fa-minus"></i> </button>';
        // $output.= '                            </div>';
        // $output.= '                        </div>';
        // $output.= '                    </li>';
        $output.= '                </ul>';
        $output.= '            </div>';
        $output.= '        </div>';
        $output.= '        <div class="content-panel-s center-c">';
        $output.= '            <h4 class="total">Subtotal: </h4>';
        $output.= '            <h5 class="total" id="total" >$. 00.00 </h5>';
        $output.= '        </div>';
        $output.= '        <div class="btn-panel center-c">';
        $output.= '            <button onclick="make_order();" class="button-item">Realizar Compra</button>';
        $output.= '        </div>';
        $output.= '    </div>';
        $output.= '</div>';

        return $output;
    }

    function login_frm(  $level = ''  ){
        $output = '';
        $output.= '<div class="overlay">';
        $output.= '    <a id="close" onclick="openModal();"><i class="fa fas fa-times"></i></a>';
        $output.= '    <div id="modal">';
        $output.= '        <input type="checkbox" id="chk" aria-hidden="true">';
        $output.= '        <div class="login">';
        $output.= '            <form>';
        $output.= '                <label for="chk" aria-hidden="true">Iniciar Sesion</label>';
        $output.= '                <input id="mailLogin" type="text" placeholder="Correo Electronico">';
        $output.= '                <input id="passwordLogin" type="password" placeholder="Password">';
        $output.= '                <input id="button-frm" onclick="login()" value="Ingresar">';
        $output.= '            </form>';
        $output.= '        </div>';
        $output.= '        <div class="register">';
        $output.= '            <form>';
        $output.= '                <label class="lbl-register" for="chk" aria-hidden="true">Registrate</label>';
        $output.= '                <input id="mailRegister" type="text" placeholder="Correo Electronico">';
        $output.= '                <input id="userRegister" type="text" placeholder="Username">';
        $output.= '                <input id="passwordRegister" type="password" placeholder="Password">';
        $output.= '                <input onclick="save_user()" type="submit" value="Registrarse">';
        $output.= '            </form>';
        $output.= '        </div>';
        $output.= '    </div>';
        $output.= '</div>';
        
        return $output;
    
    }

    function sidebar_order( $active ){
        $active_one = '';
        $active_two = '';
        $active_three = '';


        switch( $active ){
            case 1:
                $active_one = 'active-li';
            break;
            case 2:
                $active_two = 'active-li';
            break;
            case 3:
                $active_three = 'active-li';
            break;
        }

        $output = '';
        $output.= '<li>';
        $output.= '    <a onclick="validateForm( 1 );" id="sidebar-link-one" class="'. $active_one .'"><i class="fas fa-shopping-cart" aria-hidden="true"></i> Paso 1</a>';
        $output.= '</li>';
        $output.= '<li>';
        $output.= '    <a onclick="validateForm( 2 );" id="sidebar-link-two" class="'. $active_two .'"><i class="fas fa-user icon-button"></i> Paso 2</a>';
        $output.= '</li>';
        $output.= '<li>';
        $output.= '    <a onclick="validateForm( 3 );" id="sidebar-link-three" class="'. $active_three .'"><i class="fas fa-folder-open"></i> Paso 3 </a>';
        $output.= '</li>';

        return $output;

    }


    function sidebar_user( $active ){

        $active_one = '';
        $active_two = '';
        $active_three = '';


        switch( $active ){
            case 1:
                $active_one = 'active-li';
            break;
            case 2:
                $active_two = 'active-li';
            break;
            case 3:
                $active_three = 'active-li';
            break;
        }

        $output = '';
        $output.= '<li>';
        $output.= '    <a class="'. $active_one .'" href="myaccount.php"><i class="fas fa-shopping-cart" aria-hidden="true"></i> Mis Pedidos</a>';
        $output.= '</li>';
        $output.= '<li>';
        $output.= '    <a class="'. $active_two .'" href="my_data.php"><i class="fas fa-user icon-button" aria-hidden="true"></i> Mis Datos</a>';
        $output.= '</li>';
        // $output.= '<li>';
        // $output.= '    <a href="http://"><i class="fas fa-map-marker-alt"></i> Mis Direcciones</a>';
        // $output.= '</li>';
        // $output.= '<li>';
        // $output.= '    <a href="http://"><i class="fas fa-star"></i> Mis Valoraciones</a>';
        // $output.= '</li>';

        return $output;

    }

    function button_close_session( $level = '../' ){

        $output = '';
        $output.= '<form id="form2" name="form1" action="' . $level . 'logout.php" method="post">';
        $output.= '    <input type="submit" class="button-item  button-item-second" value="Cerrar Session">';
        $output.= '</form>';

        return $output;

    }


    function panel_categories(){
        $output = '';
        $output = '
        <div class="overlay-panel-second">
            <div id="panel-second">
                <button id="close-panel" onclick="view_categories();"><i class="fa fas fa-times"></i></button>
                <div class="head-panel center-c" style="height: 7%">
                    <h3>Categorias</h3>
                </div>
                <div class="main-panel">
                    <div class="list-panel-second">
                        <ul id="container-list">
                           
                        </ul>             
                    </div>
                </div>
            </div>
        </div>
        ';
        return $output;
    }


    function panel_subcategories(){
        $output = '';
        $output = '
        <div class="overlay-panel-three">
            <div id="panel-three">
                <button id="close-panel" onclick="view_subcategories();"><i class="fa fas fa-times"></i></button>
                <div class="head-panel center-c" style="height: 7%" id="">
                    <h3 id="title-category">Categorias</h3>
                </div>
                <div class="main-panel">
                    <div class="list-panel-second">
                        <ul id="container-list" class="container-list-subcategories">
                           
                        </ul>             
                    </div>
                </div>
            </div>
        </div>
        ';
        return $output;
    }

?>