// //validations
window.addEventListener( 'load', () => {
    
    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });

    var form = $( "#form" );
    form.validate({
        rules: {
            name: {
                required: true
            },
            description: {
                required: true
            }
        },
        messages : {
            name: {
                required: "El nombre es requerido"
            },
            description: {
                required: "La descripcion es requerida"
            }
        }
    });
    
} );

function table(){
 
    var container = document.getElementById( 'container-table' );
    var codeCategory = document.getElementById( 'codeCategory' );
    var codeSubcategory = document.getElementById( 'codeSubcategory' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_sub_category.php';
    var formData = new FormData();

    formData.append( 'request', 'table' );
    formData.append( 'id', codeSubcategory.value );
    formData.append( 'codeCategory', codeCategory.value );
    formData.append( 'name', '' );
    formData.append( 'description', '' );
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

    var codeCategory = document.getElementById( 'codeCategory' );
    var name = document.getElementById( 'name' );
    var description = document.getElementById( 'description' );

    if( codeCategory.value !== '' && name.value !== '' && description.value !== '' ){

        var url = 'http://localhost/commerce/SYSTEM/API/API_sub_category.php';
        var formData = new FormData();
        formData.append( 'request', 'save' );
        formData.append( 'name', name.value );
        formData.append( 'description', description.value );
        formData.append( 'codeCategory', codeCategory.value );

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
                        name.value = '';
                        description.value = '';
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


function select( category ){
    var data = '';
    var url = 'http://localhost/commerce/SYSTEM/API/API_sub_category.php';
    var codeSubcategory = document.getElementById( 'codeSubcategory' );
    var name = document.getElementById( 'name' );
    var description = document.getElementById( 'description' );
    var codeCategory = document.getElementById( 'codeCategory' );
    
    var formData = new FormData();

    formData.append( 'request', 'select' );
    formData.append( 'id', category );
    formData.append( 'codeCategory', codeCategory.value );


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
                name.value = data.subcat_name,
                description.value = data.subcat_description,
                codeSubcategory.value = data.subcat_id,
                codeCategory.value = data.subcat_category,
                table(),
                changeButtons( 2 )
                //console.log( data )
            }
        }    
    )
    .catch( error =>  console.log( error ) )

}



function update(){

    var codeSubcategory = document.getElementById( 'codeSubcategory' );
    var codeCategory = document.getElementById( 'codeCategory' );
    var name = document.getElementById( 'name' );
    var description = document.getElementById( 'description' );

    if( codeSubcategory.value !== '' && codeCategory.value != '' && name.value !== '' && description.value !== '' ){
        
        var url = 'http://localhost/commerce/SYSTEM/API/API_sub_category.php';

        var formData = new FormData();
        formData.append( 'request', 'update' );
        formData.append( 'id', codeSubcategory.value );
        formData.append( 'codeCategory', codeCategory.value );
        formData.append( 'name', name.value );
        formData.append( 'description', description.value );

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
                        codeSubcategory.value = '';
                        name.value = '';
                        description.value = '';
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



function delete_( category ){


    swal({
        title: "Esta Seguro?",
        text: "Desea eliminar esta subcategoria?",
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
                var codeCategory = document.getElementById( 'codeCategory' );
                var url = 'http://localhost/commerce/SYSTEM/API/API_sub_category.php';
                var formData = new FormData();

                formData.append( 'request', 'delete' );
                formData.append( 'id', category );
                formData.append( 'codeCategory', codeCategory.value );


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

function picture( subCategory ) {
 
    inpfile = document.getElementById( "image" );
    inpfile.click();
    var code = document.getElementById( 'codeSubcategory' );
    code.value = subCategory;

}

function chargeImage(){

    var fileField = document.querySelector("input[type='file']");
    var codeSubcategory = document.getElementById( 'codeSubcategory' );
    var codeCategory = document.getElementById( 'codeCategory' );

    var url = 'http://localhost/commerce/SYSTEM/API/API_picture_category.php';
    var formData = new FormData();

    formData.append( 'image', fileField.files[0] );
    formData.append( 'category', codeSubcategory.value );
    formData.append( 'type', 2 );


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
                    window.location.href = "edit_picture.php?codeImage=" + response.codeImage + "&category=" + codeSubcategory.value + "&type=" + 2 + "&codeCategory=" + codeCategory.value;
                })
            }
        }
    )
    .catch( error => swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    
   
}



function table_pictures_subcategory( subcategory ){
    
    openModal();
    container = document.getElementById( 'modal' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_sub_category.php';
    var formData = new FormData();

    formData.append( 'request', 'table_pictures_subcategory' );
    formData.append( 'subcategory', subcategory );
    formData.append( 'type', 2 );
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