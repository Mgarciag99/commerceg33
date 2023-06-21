<?php 
require_once( '../CLASSES/clsCategory.php' );
require_once( '../CLASSES/clsSubCategory.php' );
require_once( '../CLASSES/clsProduct.php' );

////////////////////////////////////////////////////////////////////////////////////
/////////////////////// CATEGORIES /////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

function table_categories( $code = '', $name = '', $description = '', $situation = 1 ){
        
    $ClsCategory = new category();
    $categories = $ClsCategory->get( $code, $name, $description, $situation );
    $output = '';
    if ( $categories->num_rows == 0 ){
        //no data
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han registrado Categorias';
        $output.= '</div>';
    }else{
        $output.= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
        $output.= '    <thead>';
        $output.= '        <tr>';
        $output.= '            <th>Codigo</th>';
        $output.= '            <th>Categoria</th>';
        $output.= '            <th>Descripcion</th>';
        $output.= '            <th>Opciones</th>';
        $output.= '        </tr>';
        $output.= '    </thead>';
        $output.= '    <tbody>';
        $category = '';
        $i = 1;
        while ( $category = $categories->fetch_object() ){
            $categoryId = $category->cat_id;  
            $output.= '        <tr class="odd gradeX">';
            $output.= '            <td> '. $i . ' </td>';
            $output.= '            <td> '. utf8_decode( $category->cat_name ). ' </td>';
            $output.= '            <td> '. substr( utf8_decode( $category->cat_description ), 0, 50 ) . '... </td>';
            $output.= '            <td>';
            $output.= '                 <button title="Seleccionar Categoria" class="btn btn-primary" onclick="select( ' . $categoryId . ' );"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
            $output.= '                 <button title="Eliminar Categoria" class="btn btn-danger"  onclick="delete_( ' . $categoryId . ' );"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
           // $output.= '                 <button title="Actualizar Imagen" class="btn btn-warning"  onclick="picture( ' . $categoryId . ' );"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>';
            $output.= '                 <a title="Agregar Subcategorias" class="btn btn-info" href="management_sub_category.php?category=' . $categoryId . '"><i class="fa fa-list" aria-hidden="true"></i></a>';
            $output.= '                 <button title="Visualizar" class="btn btn-success"  onclick="table_pictures_category( ' . $categoryId . ' );"><i class="fa fa-file-image-o" aria-hidden="true"></i> Adjuntar Imagenes</button>';
            $output.= '            </td>';
            $output.= '        </tr>';
            $i++;
        }
        
        $output.= '    </tbody>';
        $output.= '</table>';
    }
    
    return $output;

}



function table_subcategories( $code = '', $codesubcategory = '', $name = '', $description = '', $situation = 1 ){
        
    $ClsSubCategory = new subcategory();
    $subcategories = $ClsSubCategory->get( $code, $codesubcategory, $name, $description, $situation );
    $output = '';
    if ( $subcategories->num_rows == 0 ){
        //no data
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han registrado SubCategorias';
        $output.= '</div>';
    }else{
        $output.= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
        $output.= '    <thead>';
        $output.= '        <tr>';
        $output.= '            <th>Codigo</th>';
        $output.= '            <th>sub-categoria</th>';
        $output.= '            <th>Descripcion</th>';
        $output.= '            <th>Opciones</th>';
        $output.= '        </tr>';
        $output.= '    </thead>';
        $output.= '    <tbody>';
        $subcategory = '';
        $i = 1;
        while ( $subcategory = $subcategories->fetch_object() ){
            $subcategoryId = $subcategory->subcat_id;  
            $output.= '        <tr class="odd gradeX">';
            $output.= '            <td> '. $i . ' </td>';
            $output.= '            <td> '. utf8_decode( $subcategory->subcat_name ) . ' </td>';
            $output.= '            <td> '. substr( utf8_decode( $subcategory->subcat_description ), 0, 50 ) . '... </td>';
            $output.= '            <td>';
            $output.= '                 <button title="Seleccionar Categoria" class="btn btn-primary" onclick="select( ' . $subcategoryId . ' );"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
            $output.= '                 <button title="Eliminar Categoria" class="btn btn-danger"  onclick="delete_( ' . $subcategoryId . ' );"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
           // $output.= '                 <button title="Actualizar Imagen" class="btn btn-warning"  onclick="picture( ' . $subcategoryId . ' );"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>';
            $output.= '                 <button title="Visualizar" class="btn btn-success"  onclick="table_pictures_subcategory( ' . $subcategoryId . ' );"><i class="fa fa-file-image-o" aria-hidden="true"></i> Adjuntar Imagenes</button>';

            // $output.= '                 <a title="Agregar Subcategorias" class="btn btn-info" href="management_sub_subcategory.php?subcategory=' . $subcategoryId . '"><i class="fa fa-list" aria-hidden="true"></i></a>';
            // $output.= '                 <button title="Visualizar" class="btn btn-success"  onclick="picture( ' . $subcategoryId . ' );"><i class="fa fa-search" aria-hidden="true"></i> Visualizar</button>';
            $output.= '            </td>';
            $output.= '        </tr>';
            $i++;
        }
        
        $output.= '    </tbody>';
        $output.= '</table>';
    }
    
    return $output;

}


function table_pictures_category( $category = '', $typeFile = '1', $levelFile = '' ){

    $ClsCategory = new category();
    $resultImage = $ClsCategory->get_image_category( '', $category, '', $typeFile, 1, false );

    $output = '';
    $output.= '<br><button title="Actualizar Imagen" class="btn btn-primary"  onclick="picture( ' . $category . ' );"> Adjuntar Imagen <i class="fa fa-file-image-o" aria-hidden="true"></i></button>';
    $output.='<hr>';
    $output.='<h3 class="title"> Imagenes Disponibles</h3>';

    $output.='<div class="col-lg-12" id="container-gallery-gallery">';
    $i = 1;

    if( $resultImage->num_rows == 0 ){
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han agregado Imagenes a esta Categoria';
        $output.= '</div>';
    }else{

        while( $row = $resultImage->fetch_object() ){

            if( $i == 1 ){
                $output.='    <div class="row container-gallery">';
            }
    
            $idPicture = $row->pic_id;
            $categoryPicture = $row->pic_category;
            $imagePicture = $row->pic_image;
            $typePicture = $row->pic_type;
            $situationPicture = $row->pic_situation;
    
            if( $imagePicture != '' ){
    
                $picture = $levelFile . 'IMAGES/CATEGORY/' . $imagePicture;
    
                if( file_exists('../IMAGES/CATEGORY/' . $imagePicture) ){   
                
                    $picture = $levelFile . 'IMAGES/CATEGORY/' . $imagePicture;
                    
                }else{
                    $picture = $levelFile . 'IMAGES/noimage.png';

                }
    
            }else{
                
                $picture = $levelFile . 'IMAGES/noimage.png';
    
            }
           
    
            $output.='        <div class="col-lg-3">';
            $output.='            <img class="img-gallery img-thumbnail" src="' . $picture . '" width="100%" height="100%" alt="" srcset="">';
            $output.='            <p class="text-muted">Subida el: 01/03/2000</p>';
            $output.='        </div>';
    
            if( $i == 4 ){
                $output.='    </div>';
                $i = 0;
            }
    
            $i++;
        }
    }
    
    $output.='</div>';

    return $output;

}



function select_categories( $code = '', $name = '', $description = '', $situation = 1 ){
        
    $ClsCategory = new category();
    $categories = $ClsCategory->get( $code, $name, $description, $situation );
    $output = '';
    if ( $categories->num_rows == 0 ){
        //no data
        $output.= '<option value"">';
        $output.= ' No hay data disponible';
        $output.= '</option>';
    }else{
        // $output.= '<select >';
        $category = '';
        $i = 1;
        $output.= '<option value="" >Seleccione</option>';

        while ( $category = $categories->fetch_object() ){
            $categoryId = $category->cat_id;  
            $categoryName = $category->cat_name;  
            $output.= '<option value="' . $categoryId . '" > '. $categoryName . ' </option>';
            $i++;
        }
        
        // $output.= '    </select>';
    }
    
    return $output;

}


function select_subcategories( $code = '', $codesubcategory = '', $name = '', $description = '', $situation = 1 ){
        
    $ClsSubCategory = new subcategory();
    $output = '';

    if( $codesubcategory != '' ){
        $subcategories = $ClsSubCategory->get( $code, $codesubcategory, $name, $description, $situation );
        if ( $subcategories->num_rows == 0 ){
            //no data
            $output.= '<option value"">';
            $output.= ' No hay data disponible';
            $output.= '</option>';
        }else{
            // $output.= '<select >';
            $category = '';
            $i = 1;
            $output.= '<option value="" >Seleccione</option>';
            while ( $category = $subcategories->fetch_object() ){
                $subcategoryId = $category->subcat_id;  
                $subcategoryName = $category->subcat_name;  
                $output.= '<option value="' . $subcategoryId . '" > '. $subcategoryName . ' </option>';
                $i++;
            }
            
            // $output.= '    </select>';
        }
    }else{
        $output.= '<option value"">';
        $output.= 'Seleccionar una categoria';
        $output.= '</option>';
    }
    
    
    return $output;

}

////////////////////////////////////////////////////////////////////////////////////
/////////////////////// END CATEGORIES//////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////
/////////////////////// PRODUCTS ///////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

function table_products(  $id = '', $category = '', $subCategory = '', $name = '', $description = '', $stock = '', $price = '', $situation = 1 ){
        
    $ClsPro = new product();
    $products = $ClsPro->get(  $id, $category, $subCategory, $name, $description, $stock, $price, $situation );
    $output = '';
    if ( $products->num_rows == 0 ){
        //no data
        $output.= '<div class="alert alert-info text-center">';
        $output.= ' Aun no se han registrado Productos';
        $output.= '</div>';
    }else{
        $output.= '<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
        $output.= '    <thead>';
        $output.= '        <tr>';
        $output.= '            <th>Codigo</th>';
        $output.= '            <th>Categoria</th>';
        $output.= '            <th>Sub Categoria</th>';
        $output.= '            <th>Nombre</th>';
        // $output.= '            <th>Descripcion</th>';
        $output.= '            <th>Stock</th>';
        $output.= '            <th>Precio</th>';
        $output.= '            <th>Opciones</th>';
        $output.= '        </tr>';
        $output.= '    </thead>';
        $output.= '    <tbody>';
        $category = '';
        $i = 1;
        while ( $product = $products->fetch_object() ){
            $productId = $product->pro_id ;
            $productCatName =  $product->cat_name;  
            $productSubCatName = $product->subcat_name;  
            $productName = utf8_decode( $product->pro_name );  
            $productDescription = utf8_decode( $product->pro_description );  
            $productStock = $product->pro_stock;  
            $productPrice = $product->pro_price;  
            $productSituation = $product->pro_situation;  

            $output.= '        <tr class="odd gradeX">';
            $output.= '            <td> '. $i . ' </td>';
            $output.= '            <td>' . utf8_decode( $productCatName ) . '</td>';
            $output.= '            <td>' . utf8_decode( $productSubCatName ) . '</td>';
            $output.= '            <td>' . utf8_decode( $productName ) . '</td>';
            $output.= '            <td>' . $productStock . '</td>';
            $output.= '            <td>' . $productPrice . '</td>';
            
            $output.= '            <td>';
            $output.= '                 <button title="Seleccionar Producto" class="btn btn-primary" onclick="select( ' . $productId . ' );"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
            $output.= '                 <button title="Eliminar Producto" class="btn btn-danger"  onclick="delete_( ' . $productId . ' );"><i class="fa fa-trash-o" aria-hidden="true"></i></button>';
            $output.= '                 <button title="Visualizar" class="btn btn-success"  onclick="table_pictures_product( ' . $productId . ' );"><i class="fa fa-file-image-o" aria-hidden="true"></i> Adjuntar Imagenes</button>';
            $output.= '            </td>';
            $output.= '        </tr>';
            $i++;
        }
        
        $output.= '    </tbody>';
        $output.= '</table>';
    }
    
    return $output;

}



function table_pictures_product( $product = '', $levelFile = '' ){

    $ClsPro = new product();
    $resultImage = $ClsPro->get_image_product( '', $product, '', '', 1, false );

    $output = '';
    $output.= '<br><button title="Actualizar Imagen" class="btn btn-primary"  onclick="picture( ' . $product . ' );"> Adjuntar Imagen <i class="fa fa-file-image-o" aria-hidden="true"></i></button>';
    $output.='<hr>';
    $output.='<h3 class="title"> Imagenes Disponibles</h3>';
    $output.='<div class="col-lg-12" id="container-gallery-gallery">';
    $i = 1;

    if( $resultImage->num_rows == 0 ){
        $output.= '<div class="alert alert-info">';
        $output.= ' Aun no se han agregado Imagenes a este Producto';
        $output.= '</div>';
    }else{
        while( $row = $resultImage->fetch_object() ){

            if( $i == 1 ){
                $output.='    <div class="row container-gallery">';
            }
    
            $idPicture = $row->pic_id;
            $productPicture = $row->pic_product;
            $imagePicture = $row->pic_image;
            $datePicture = $row->pic_date;
            $situationPicture = $row->pic_situation;
    
            if( $imagePicture != '' ){
    
                $picture = $levelFile . 'IMAGES/PRODUCT/' . $imagePicture;
    
                if( file_exists('../IMAGES/PRODUCT/' . $imagePicture) ){   
                
                    $picture = $levelFile . 'IMAGES/PRODUCT/' . $imagePicture;
                    
                }else{
                    $picture = $levelFile . 'IMAGES/noimage.png';

                }
    
            }else{
                
                $picture = $levelFile . 'IMAGES/noimage.png';
    
            }
           
    
            $output.='        <div class="col-lg-3">';
            $output.='            <img class="img-gallery img-thumbnail" src="' . $picture . '" width="100%" height="100%" alt="" srcset="">';
            $output.='            <p class="text-muted">Subida el: ' . $datePicture . '</p>';
            $output.='        </div>';
    
            if( $i == 4 ){
                $output.='    </div>';
                $i = 0;
            }
    
            $i++;
        }
    }
    
    $output.='</div>';

    return $output;

}



?>