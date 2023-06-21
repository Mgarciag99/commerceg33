<?php 
require_once( 'module_pages.php' );

?>
<!DOCTYPE html>
<html lang="en">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <header>
        <!-- navbar -->
        <?= navbar( '../' )?>
        <!-- navbar -->
        <div class="space"></div>
        <div class="space"></div>
        <div class="space"></div>
        <div class="container-header-titles">
            <h1 id="title-header">Tienda En linea</h1>
            <h2 id="title-header-sec">La mejor tienda del pais</h2>
            <input class="search" type="text" placeholder="A donde vas?">
        </div>
    </header>



    <!-- end navbar -->
    <div class="space"></div>
    <div class="space"></div>

    <!-- shopping cart-->
    <?= shopping_cart(); ?>
    <!-- end cart-->

    <!-- section -->
    <section>
        <div class="content-carrousel">
            <div class="carrousel">
                <div class="carrousel-images">
                    <div class="img">
                        <img class="" src="../ASSETS.V_01/img/tienda-en-linea.jpg" alt="" srcset="">
                        <a class="title-image" href="#">Oferta 1</a>
                    </div>
                    <div class="img">
                        <img class="" src="../ASSETS.V_01/img/tienda-en-linea.jpg" alt="" srcset="">
                        <a class="title-image" href="#">Oferta 2</a>
                    </div>
                    <div class="img">
                        <img class="" src="../ASSETS.V_01/img/tienda-en-linea.jpg" alt="" srcset="">
                        <a class="title-image" href="#">Oferta 3</a>
                    </div>
                    <div class="img">
                        <img class="" src="../ASSETS.V_01/img/tienda-en-linea.jpg" alt="" srcset="">
                        <a class="title-image" href="#">Oferta 4</a>
                    </div>
                </div>
                <div class="carrousel-content">
                    <div id="content-carrousel">
                        <div class="item-1">
                            <h2>Primero</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias doloremque sed alias</p>
                            <div class="images-content">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                            </div>
                            <a class="button-item button-item-card txt-center" href=""><i class="fas fa-mouse-pointer"></i> Mas Informacion</a>
                        </div>
                        <div class="item-1">
                            <h2>Segundo</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias doloremque sed alias</p>
                            <div class="images-content">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                            </div>
                            <a class="button-item button-item-card txt-center" href=""><i class="fas fa-mouse-pointer"></i> Mas Informacion</a>
                        </div>
                        <div class="item-1">
                            <h2>Tercero</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias doloremque sed alias</p>
                            <div class="images-content">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                            </div>
                            <a class="button-item button-item-card txt-center" href=""> <i class="fas fa-mouse-pointer"></i> Mas Informacion</a>
                        </div>
                        <div class="item-1">
                            <h2>Cuarto</h2>
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias doloremque sed alias, a
                                eius facilis in magni minus, quae iste rerum est! Provident expedita ratione quam doloribus
                                odio quaerat voluptatibus.</p>
                            <div class="images-content">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                                <img src="assets/img/descarga (3).jpg" alt="" srcset="">
                            </div>
                            <a class="button-item button-item-card txt-center" href=""><i class="fas fa-mouse-pointer"></i> Mas Informacion</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carrousel-arrows">
                <button id="arrow-left"><i class="fas fa-chevron-left"></i></button>
                <button id="arrow-right"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>



        <div id="main-two">
            <div class="container">
        
                <h1 class="title"> Productos</h1>
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
        <div id="main-three">
            <div class="container">
                <div class="card-simple">
                    <div class="item-image">
                        <img src="../ASSETS.V_01/img/tienda-en-linea.jpg" alt="" srcset="" width="100%">
                    </div>
                    <div class="item-content">
                        <h2>Item opcional</h2>
                        <p>Lur adipisicing eliLorem ipsum dolor sit, amet consectetur adipisicing eliLorem ipsum dolor sit, amet
                            consectetur adipisicing eliLorem ipsum dolor sit, amet consectetur adipisicing eli</p>
                        <a href="button-r-i" class="button-item button-item-card" >More info..</a>
                    </div>
                </div>
                <div class="space"></div>
                <div class="space"></div>
                <div class="card-simple">
                    <div class="item-content">
                        <h2 class="title-r-i">Item opcional </h2>
                        <p>Lur adipisicing eliLorem ipsum dolor sit, amet consectetur adipisicing eliLorem ipsum dolor sit, amet
                            consectetur adipisicing eliLorem ipsum dolor sit, amet consectetur adipisicing eli</p>
                            <a href="button-r-i" class="button-item button-item-card" >More info..</a>
                    </div>
                    <div class="item-image">
                        <img src="../ASSETS.V_01/img/tienda-en-linea.jpg" alt="" srcset="" width="100%">
                    </div>
                </div>
            </div>
        </div>

        
    </section>
    <!-- end section -->
    <?=footer( '../' ); ?>
    <?= script_js( '../' ); ?>
    <!-- <script src="../ASSETS.V_01/js/scripts_modules/category/category.js"></script> -->
    <script src="../ASSETS.V_01/js/scripts_modules/product/product-js.js"></script>
    <script src="../ASSETS.V_01/js/scripts_modules/user/user.js"></script>
    <script>
        // navBarr = document.getElementById('nav');
        // navBarr.classList.remove('scroll-nav');

        window.onscroll = function (e) { 
            // navBarr = document.getElementById('nav');
            // var button = document.querySelectorAll( '.button-nav')
            // // console.log( button )
            // for( var i = 0; i < button.length; i++ ){
            //     button[ i ].classList.add('button-nav-scroll');
            // }

            // scrollDown = window.scrollY;
            // if(scrollDown > 0){
            //     navBarr.classList.add('scroll-nav');
            // }else{
            //     navBarr.classList.remove('scroll-nav');
            // }
        }
    </script>

</body>
</html>