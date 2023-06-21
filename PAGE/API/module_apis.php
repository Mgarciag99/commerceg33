<?php 
require_once( '../CLASSES/clsCategory.php' );
require_once( '../CLASSES/clsSubCategory.php' );
require_once( '../CLASSES/clsProduct.php' );
require_once( '../CLASSES/ClsUser.php' );
require_once( '../CLASSES/ClsOrder.php' );
require_once( '../CLASSES/ClsDetailOrder.php' );
require_once( '../CLASSES/ClsDetailOrderData.php' );


function carrousel_categories(  $id = '', $name = '', $description = '', $type = 1, $situation = 1, $levelFile = ''){
    $ClsCategory = new category();
    $categories = $ClsCategory->get_category_picture( $id, $name, $description, $type, $situation );
    $output = '';
    if ( $categories->num_rows == 0 ){
        //no data
        $output.= '<div class="alert-info">';
        $output.= ' Aun no se han registrados Categorias';
        $output.= '</div>';
    }else{
        
        $category = '';
        $catAux = '';
        $i = 1;
        $width = '';
        $margin = '';
        $sizeArray = $categories->num_rows;
            
        switch( $sizeArray ){
            case 1:
                $width = '100%';
                $margin = '0%';
            break;
            case 2:
                $width = '100%';
                $margin = '0%';
            break;
            case 3:
                $width = '100%';
                $margin = '0%';
            break;
            case 4:
                $width = '100%';
                $margin = '0%';
            break;

            case 5:
                $width = '200%';
                $margin = '-100%';
            break;
            case 6:
                $width = '200%';
                $margin = '-100%';
            break;
            case 7:
                $width = '200%';
                $margin = '-100%';
            break;
            case 8:
                $width = '200%';
                $margin = '-100%';
            break;
            case 9:
            break;
        }
        //$output.= '<div class="carrousel-cards" style = "width: '. $width .'; margin-left: 0% ">';
        $output.= '<div class="carrousel-cards" style = "width: 300% ; margin-left: -100%">';

        $count = 0;
        while ( $category = $categories->fetch_object() ){

            
            //table category
            $categoryId = $category->cat_id;
            $categoryName = $category->cat_name;  
            $categoryDescription = $category->cat_description;  
            $categorySituation = $category->cat_situacion;  
            //table images
            $idPicture = $category->pic_id;
            $categoryPicture = $category->pic_category;
            $imagePicture = $category->pic_image;
            $typePicture = $category->pic_type;
            $situationPicture = $category->pic_situation;
            $catAux = $categoryId;



            if( $i == 1 ){
                $count++;
                $output.= '<div class="card-item" >';
            }

            if( $imagePicture != '' ){
    
                $picture = $levelFile . 'SYSTEM/IMAGES/CATEGORY/' . $imagePicture;
    
                if( file_exists('../../SYSTEM/IMAGES/CATEGORY/' . $imagePicture) ){   
                
                    $picture = $levelFile . 'SYSTEM/IMAGES/CATEGORY/' . $imagePicture;
                    
                }else{
                    $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';

                }
    
            }else{
                
                $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
    
            }
            $output.= '<a href="subcategories.php?code=' . $categoryId . '" title="Ir a la categoria">';
            $output.= '    <div class="card">';
            $output.= '        <div class="card-img">';
            $output.= '            <img class="" src="' . $picture . '" alt="' . $categoryName . '" srcset="">';
            $output.= '        </div>';
            $output.= '        <div class="card-content">';
            $output.= '            <h2>' . $categoryName . '</h2>';
            $output.= '        </div>';
            $output.= '    </div>';
            $output.= '</a>';

            if( $i == 4 ){
                $output.= '</div>';
                $i = 0;
            }
            $i++;
            
        }
        $output.= '<input type="hidden" id="total-items" value="' . $count . '">';
        
        $output.= '</div>';
        
    }
    
    return $output;

}

function carrousel_subcategories( $codeCategory = '', $id = '', $category = '', $image = '', $type = 2, $situation = 1, $levelFile = ''){
    $ClsSubCategory = new subcategory();
    $subcategories = $ClsSubCategory->get_subcategory_picture( $codeCategory, $id, $category, $image, $type, $situation, 1 );
    //var_dump( $subcategories );die();
    $output = '';
    if ( $subcategories->num_rows == 0 ){
        //no data
        $output.= '<div class="alert-info">';
        $output.= ' Aun no se han registrado Sub Categorias';
        $output.= '</div>';
    }else{
        
        $subcategorie = '';
        $catAux = '';
        $i = 1;
        $width = '';
        $sizeArray = $subcategories->num_rows;
        $width = ( $sizeArray * 100 );

        switch( $width ){
            case 100:
                $margin = 0;
            break;
        }
       
        $output.= '<div class="carrousel-cards" style = "width: '. $width .'% ; margin-left: '. $margin .'%">';
        // $output.= '<div class="carrousel-cards" style = "width: '. $width .'; margin-left: '. $margin .' ">';

        while ( $subcategorie = $subcategories->fetch_object() ){

            
            //table category
            $subcategoryId = $subcategorie->subcat_id;
            $subcategoryCategory = $subcategorie->subcat_category;
            $subcategoryName = $subcategorie->subcat_name;  
            $subcategoryDescription = $subcategorie->subcat_description;  
            $subcategorySituation = $subcategorie->subcat_situation;  
            //table images
            $idPicture = $subcategorie->pic_id;
            $categoryPicture = $subcategorie->pic_category;
            $imagePicture = $subcategorie->pic_image;
            $typePicture = $subcategorie->pic_type;
            $situationPicture = $subcategorie->pic_situation;
            $catAux = $subcategoryId;

           // if( $categoryId != $catAux ){

                if( $i == 1 ){
                    $output.= '<div class="card-item">';
                }

                if( $imagePicture != '' ){
        
                    $picture = $levelFile . 'SYSTEM/IMAGES/CATEGORY/' . $imagePicture;
        
                    if( file_exists('../../SYSTEM/IMAGES/CATEGORY/' . $imagePicture) ){   
                    
                        $picture = $levelFile . 'SYSTEM/IMAGES/CATEGORY/' . $imagePicture;
                        
                    }else{
                        $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
    
                    }
        
                }else{
                    
                    $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
        
                }
    
                $output.= '<a href="bysubcategories.php?code=' . $subcategoryId . '&codeCategory=' . $subcategoryCategory . '" title="Ir a la sub categoria">';
                $output.= '    <div class="card">';
                $output.= '        <div class="card-img">';
                $output.= '            <img class="" src="' . $picture . '" alt="' . $subcategoryId . '" srcset="">';
                $output.= '        </div>';
                $output.= '        <div class="card-content">';
                $output.= '            <h2>' . $subcategoryName . '</h2>';
                $output.= '        </div>';
                $output.= '    </div>';
                $output.= '</a>';
    
                if( $i == 4 ){
                    $output.= '</div>';
                    $i = 0;
                }
                $i++;
            //}
            

            
        }
        
        $output.= '</div>';

        
    }
    
    return $output;

}


function products( $id = '', $category = '', $subcategory = '', $name = '', $description = '', $price = '', $stock = '', $situation = 1, $levelFile = '', $last_id = '' ){
    $ClsProduct = new product();
    $products = $ClsProduct->get( $id, $category, $subcategory, $name, $description, $price, $stock, $situation, 8, $last_id );
    //var_dump( $subcategories );die();
    $output = '';
    if ( $products->num_rows == 0 ){
        //no data
        // $output.= '<div class="alert-info">';
        // $output.= ' Aun no se han registrado Productos';
        // $output.= '</div>';
    }else{

        $i = 1;
        $count = 0;
        while ( $product = $products->fetch_object() ){

            $imageProduct = '';
            $imagePicture = '';
            $picture = '';

            //table product
            $productId = $product->pro_id;
            $productCategory = $product->pro_category;
            $productSubcategory = $product->pro_subcategory;  
            $productName = $product->pro_name;  
            $productDescription = $product->pro_description;  
            $productStock = $product->pro_stock;  
            $productPrice = $product->pro_price;  
            $productSituation = $product->pro_situation;  
            //table category
            $categoryId = $product->cat_id;
            $categoryName = $product->cat_name;  
            $categoryDescription = $product->cat_description;  
            $categorySituation = $product->cat_situacion;  
            //table sub category
            $subcategoryId = $product->subcat_id;
            $subcategoryCategory = $product->subcat_category;
            $subcategoryName = $product->subcat_name;  
            $subcategoryDescription = $product->subcat_description;  
            $subcategorySituation = $product->subcat_situation;  
            
            //get image
            $imageProduct = $ClsProduct->get_image_product( '', $productId, '', '', 1, true );

            if( $imageProduct ){
                
                while ( $image = $imageProduct->fetch_object() ){
                    $imagePicture = $image->pic_image;
                }
            
            }else{
                    
                $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
    
            }


            if( $imagePicture != '' ){
    
                $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $imagePicture;
    
                if( file_exists('../../SYSTEM/IMAGES/PRODUCT/' . $imagePicture) ){   
                
                    $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $imagePicture;
                    
                }else{
                    $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';

                }
    
            }else{
                    
                $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
    
            }

            if( $i == 1 ){
                $output.= '<div class="row-area">';
            }

            
            $count++;
            $output.= '    <a href="view-product.php?code=' . $productId . '" title="Ir al producto">';
            $output.= '    <div class="item" id="' . $productId . '">';
            $output.= '        <div class="item-img">';
            $output.= '            <img width="100%" heigth="100%" src="' . $picture . '" alt="" srcset="">';
            $output.= '        </div>';
            $output.= '        <div class="item-content">';
            $output.= '            <h2>' . $productName . '</h2>';
            $output.= '            <h3> $. ' . $productPrice . ' </h3>';
            
            $output.= '            <a class="button-item button-item-card" href="view-product.php?code=' . $productId . '" title="Ir al producto" ><i class="fas fa-shopping-cart"></i> Comprar</a>';
            //$output.= '            <a class="button-item button-item-card" onclick="addToCarrShop()" title="Ir al producto" ><i class="fas fa-shopping-cart"></i> Comprar</a>';
            
            $output.= '        </div>';
            $output.= '    </div>';
            $output.= '    </a>';

            if( $i == 4 ){
                $output.= '</div>';
                $output.= '<div class="space"></div>';
                $i = 0;
            }
            
            $i++;
            
        }
        

        
    }
    
    return $output;

}


function carrousel_pictures_products(  $id = '', $product = '', $image = '', $date = '', $situation = 1, $levelFile = '' ){
    $ClsProduct = new product();
    $products = $ClsProduct->get_image_product( $id, $product, $image, $date, 1, false );
    $output = '';
    if ( $products->num_rows == 0 ){
        //no data
        $output.= '<div class="alert-info">';
        $output.= ' Aun no se han registrados Imagenes';
        $output.= '</div>';
    }else{

        $i = 1;
        $width = '';
        $sizeArray = $products->num_rows;
        $width = ( $sizeArray * 100 );

        switch( $width ){
            case 100:
                $margin = 0;
            break;
        }
       
        $output.= '<div class="carrousel-cards" style = "width: '. $width .'% ; margin-left: '. $margin .'%">';

        $count = 0;
        while ( $product = $products->fetch_object() ){

            
            //table pictures
            $productPicId = $product->pic_id ;
            $productPicName = $product->pic_product ;  
            $productPicImage = $product->pic_image;  
            $productPicSituation = $product->pic_date;  
            $productPicPicture = $product->pic_situation;



            $count++;
            $output.= '<div class="card-item" >';

            if( $productPicImage != '' ){
    
                $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $productPicImage;
    
                if( file_exists('../../SYSTEM/IMAGES/PRODUCT/' . $productPicImage) ){   
                
                    $picture = $levelFile . 'SYSTEM/IMAGES/PRODUCT/' . $productPicImage;
                    
                }else{
                    $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';

                }
    
            }else{
                
                $picture = $levelFile . 'SYSTEM/IMAGES/noimage.png';
    
            }
            $output.= '    <div class="card">';
            $output.= '        <div class="card-img">';
            $output.= '            <img class="" src="' . $picture . '" alt="" srcset="">';
            $output.= '        </div>';
            $output.= '    </div>';

            $output.= '</div>';
        
            $i++;
            
        }
        $output.= '<input type="hidden" id="total-items" value="' . $count . '">';
        
        $output.= '</div>';
        
    }
    
    return $output;

}

function list_categoriess( $code = '', $name = '', $description = '', $situation = 1 ){
        
    $ClsCategory = new category();
    $categories = $ClsCategory->get( $code, $name, $description, $situation );
    $output = '';
    if ( $categories->num_rows == 0 ){
        //no data
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han registrado Categorias';
        $output.= '</div>';
    }else{
        $category = '';
        $i = 1;
        while ( $category = $categories->fetch_object() ){
            $output.= '        <li>';
            $output.= '            <a onclick="list_subcategories( ' . trim( $category->cat_id ) . ', this.textContent  )">';
            $output.= '            <i class="fa fa-solid fa-caret-right"></i>  ';
            $output.=                   utf8_decode( $category->cat_name );
            $output.= '            </a>';
            $output.= '        </li>';
            $i++;
        }
        
    }
    
    return $output;

}



function list_subcategories( $code = '', $codesubcategory = '', $name = '', $description = '', $situation = 1 ){
        
    $ClsSubCategory = new subcategory();
    $subcategories = $ClsSubCategory->get( $code, $codesubcategory, $name, $description, $situation );
    $output = '';
    if ( $subcategories->num_rows == 0 ){
        //no data
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han registrado subcategorias';
        $output.= '</div>';
    }else{
        $subcategory = '';
        $i = 1;
        while ( $subcategory = $subcategories->fetch_object() ){
            $output.= '        <li>';
            $output.= '            <a href="../PAGES/bysubcategories.php?code=' . trim( $subcategory->subcat_id ) . '&codeCategory=' . trim( $subcategory->cat_id ) . '">';
            $output.= '            <i class="fa fa-solid fa-caret-right"></i>  ';
            $output.=                   utf8_decode( $subcategory->subcat_name );
            $output.= '            </a>';
            $output.= '        </li>';
            $i++;
        }
        
    }
    
    return $output;

}


function search_list_products( $name = '' ){
    $ClsProduct = new product();
    $products = $ClsProduct->get( '', '',  '' , $name );
    $output = '';
    if ( $products->num_rows == 0 ){
        //no data
        $output.= '<div class="alert-info">';
        $output.= ' No existen Productos con la busqueda realizada';
        $output.= '</div>';
    }else{

        while ( $product = $products->fetch_object() ){

            //table product
            $productId = $product->pro_id;
            $productCategory = $product->pro_category;
            $productSubcategory = $product->pro_subcategory;  
            $productName = $product->pro_name;  
            $productDescription = $product->pro_description;  
            $productStock = $product->pro_stock;  
            $productPrice = $product->pro_price;  
            $productSituation = $product->pro_situation;  
            $output.= '        <li>';
            $output.= '            <a title="ver producto" href="../PAGES/view-product.php?code=' . trim( $productId ) . '">';
            $output.= '            <i class="fas fa-search"></i>  ';
            $output.=                   utf8_decode( $productName );
            $output.= '            </a>';
            $output.= '        </li>';
            
        }
        
    }
    
    return $output;

}

?>