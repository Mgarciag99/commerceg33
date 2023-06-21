// //validations
window.addEventListener( 'load', () => {
    
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    var form = $( "#form" );
    form.validate({
        rules: {
            category: {
                required: true
            },
            subcategory: {
                required: true
            },
            name: {
                required: true
            },
            description: {
                required: true
            },
            price: {
                required: true
            },
            stock: {
                required: true
            }
        },
        messages : {
            category: {
                required: "La categoria es requerida"
            },
            subcategory: {
                required: "La subcategoria es requerida"
            },
            name: {
                required: "El nombre es requerido"
            },
            description: {
                required: "La descripcion es requerida"
            },
            price: {
                required: "El precio es requerido"
            },
            stock: {
                required: "El stock es requerido"
            }
        }
    });
    
} );

function table(){
 
    var container = document.getElementById( 'container-table' );
    var code = document.getElementById( 'code' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_product.php';
    var formData = new FormData();

    formData.append( 'request', 'table' );
    formData.append( 'id', code.value );
    formData.append( 'category', '' );
    formData.append( 'subcategory', '' );
    formData.append( 'name', '' );
    formData.append( 'description', '' );
    formData.append( 'stock', '' );
    formData.append( 'price', '' );
    formData.append( 'situation', 1 );

    fetch( url, {
        method: 'POST', 
        body: formData,
    } )
    .then( response => response.json() )
    .then(
        response => {
        
            if( response.status !== true ){
                swal("Error!", response.message, "info")   
            }else{
                container.innerHTML = response.data
                $( '#dataTables-example' ).DataTable({
                    responsive: true
                });
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}

function save(){

    var category = document.getElementById( 'category' );
    var subcategory = document.getElementById( 'subcategory' );
    var name = document.getElementById( 'name' );
    var description = document.getElementById( 'description' );
    var stock = document.getElementById( 'stock' );
    var price = document.getElementById( 'price' );

    if( category.value !== '' && subcategory.value !== '' && name.value !== '' && description.value !== '' && stock.value != '' && price.value != '' ){

        var url = 'http://localhost/commerce/SYSTEM/API/API_product.php';
        var formData = new FormData();
        formData.append( 'request', 'save' );
        formData.append( 'category', category.value );
        formData.append( 'subCategory', subcategory.value );
        formData.append( 'name', name.value );
        formData.append( 'description', description.value );
        formData.append( 'stock', stock.value );
        formData.append( 'price', price.value );

        fetch( url, {
            method: 'POST', 
            body: formData,
        } )
        .then( 
            response => response.json()
        )
        .then( 
            response => {
                if( response.status !== true ){
                    swal("Error!", response.message, "info")   
                }else{
                    swal("Excelente!", response.message, "success").then((value) => {
                        category.value = '';
                        subcategory.value = '';
                        name.value = '';
                        description.value = '';
                        stock.value = '';
                        price.value = '';
                        table();
                    })
                }
            }
        )
        .catch( error => swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    }else{

        var form = $( "#form" );
        form.valid();
        swal( "Error!", "Debe llenar los campos Obligatorios", "info" ); 
    
    }
    
}


function select( product ){
    var data = '';
    var url = 'http://localhost/commerce/SYSTEM/API/API_product.php';
    var code = document.getElementById( 'code' );
    var category = document.getElementById( 'category' );
    var subcategory = document.getElementById( 'subcategory' );
    var name = document.getElementById( 'name' );
    var description = document.getElementById( 'description' );
    var stock = document.getElementById( 'stock' );
    var price = document.getElementById( 'price' );
    var formData = new FormData();

    formData.append( 'request', 'select' );
    formData.append( 'id', product );

    fetch( url, {
        method: 'POST', 
        body: formData,
    } )
    .then( response => response.json() )
    .then( 
        response => {
            if( response.status !== true ){
                swal("Error!", response.message, "info")   
            }else{
                data = response.data,
                list_subcategory( data.pro_category );
                code.value = data.pro_id,
                category.value = data.pro_category,
                subcategory.value = data.pro_subcategory,
                name.value = data.pro_name,
                description.value = data.pro_description,
                stock.value = data.pro_stock,
                price.value = data.pro_price,
                table(),
                changeButtons( 2 )
            }
        }    
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

}



function update(){

    var code = document.getElementById( 'code' );
    var category = document.getElementById( 'category' );
    var subcategory = document.getElementById( 'subcategory' );
    var name = document.getElementById( 'name' );
    var description = document.getElementById( 'description' );
    var stock = document.getElementById( 'stock' );
    var price = document.getElementById( 'price' );

    if( code.value !== '' && category.value !== '' && subcategory.value !== '' && name.value !== '' && description.value !== '' && stock.value != '' && price.value != '' ){
        
        var url = 'http://localhost/commerce/SYSTEM/API/API_product.php';

        var formData = new FormData();
        formData.append( 'request', 'update' );
        formData.append( 'id', code.value );
        formData.append( 'category', category.value );
        formData.append( 'subCategory', subcategory.value );
        formData.append( 'name', name.value );
        formData.append( 'description', description.value );
        formData.append( 'stock', stock.value );
        formData.append( 'price', price.value );
        fetch( url, {
            method: 'POST', 
            body: formData,
        } )
        .then( response => response.json() )
        .then( 

            response => {
                if( response.status !== true ){
                    swal("Error!", response.message, "info")   
                }else{
                    swal("Excelente!", response.message, "success").then((value) => {
                        code.value = '';
                        category.value = '';
                        subcategory.value = '';
                        name.value = '';
                        description.value = '';
                        stock.value = '';
                        price.value = '';
                        table();
                        changeButtons( 1 )
                    })
                }
            }
            
        )
        .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    }else{

        var form = $( "#form" );
        form.valid();
        swal( "Error!", "Debe llenar los campos Obligatorios", "info" ); 
    
    }

}



function delete_( id ){


    swal({
        title: "Esta Seguro?",
        text: "Desea eliminar esta categoria?",
        icon: "warning",
        buttons: {
            cancel: "Cancelar",
            ok: {
                text: "Aceptar",
                value: true,
            },
        },
    }).then((value) => {
        switch (value) {
            case true:
                var url = 'http://localhost/commerce/SYSTEM/API/API_product.php';
                var formData = new FormData();

                formData.append( 'request', 'delete' );
                formData.append( 'id', id );

                fetch( url, {
                    method: 'POST', 
                    body: formData,
                } )
                .then( response => response.json() )
                .then( 

                    response => {
                        if( response.status !== true ){
                            swal("Error!", response.message, "info")   
                        }else{
                            swal("Excelente!", response.message, "success").then((value) => {
                                table();
                                changeButtons( 1 )
                            })
                        }
                    }
                    
                )
                .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )
                break;

            default:
                swal("", "Accion Cancelada...", "info");
        }
    });
    
}
////////////////////////////////////////////////////////////
/////////////// FILES //////////////////////////////////////
////////////////////////////////////////////////////////////

function picture( product ) {
 
    inpfile = document.getElementById( "image" );
    inpfile.click();
    var code = document.getElementById( 'code' );
    code.value = product;

}

function chargeImage(){

    var fileField = document.querySelector("input[type='file']");
    var code = document.getElementById( 'code' );

    var url = 'http://localhost/commerce/SYSTEM/API/API_picture_product.php';
    var formData = new FormData();

    formData.append( 'image', fileField.files[0] );
    formData.append( 'product', code.value );

    fetch( url, {
        method: 'POST', 
        body: formData,
    } )

    .then( 
        response => response.json()
    )
    .then( 
        response => {
            if( response.status !== true ){
                swal("Error!", response.message, "info")   
            }else{
                swal("Excelente!", response.message, "success").then((value) => {
                    window.location.href = "edit_picture.php?codeImage=" + response.codeImage + "&product=" + code.value;
                })
            }
        }
    )
    .catch( error => swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    
   
}


function table_pictures_product( product ){
    
    openModal();
    container = document.getElementById( 'modal' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_product.php';
    var formData = new FormData();

    formData.append( 'request', 'table_pictures_product' );
    formData.append( 'product', product );
    formData.append( 'levelFile', '../../' );

    fetch( url, {
        method: 'POST', 
        body: formData,
    } )
    .then( response => response.json() )
    .then(
        response => {
        
            if( response.status !== true ){
                swal("Error!", response.message, "info")   
            }else{
                container.innerHTML = response.data
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}