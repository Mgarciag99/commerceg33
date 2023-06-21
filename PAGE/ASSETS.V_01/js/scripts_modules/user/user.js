// //validations
window.addEventListener( 'load', () => {
    
    // jQuery.validator.setDefaults({
    //     debug: true,
    //     success: "valid"
    // });

    // var form = $( "#form" );
    // form.validate({
    //     rules: {
    //         name: {
    //             required: true
    //         },
    //         description: {
    //             required: true
    //         }
    //     },
    //     messages : {
    //         name: {
    //             required: "El nombre es requerido"
    //         },
    //         description: {
    //             required: "La descripcion es requerida"
    //         }
    //     }
    // });
    
} );
function login(){

    var mailLogin = document.getElementById( 'mailLogin' )
    var passwordLogin = document.getElementById( 'passwordLogin' )


    if( mailLogin.value !== '' && passwordLogin.value !== '' ){

        var url = 'http://localhost/commerce/PAGE/API/API_user.php';
        var formData = new FormData();
        formData.append( 'request', 'login' );
        formData.append( 'mail', mailLogin.value );
        formData.append( 'password', passwordLogin.value );

        fetch( url, {
            method: 'POST', 
            body: formData,
        } )
        .then( response => response.json() )
        .then( 
            response => {
                if( response.status !== true ){
                    //alert( "error" );
                    //console.log( response )
                    swal("Error!", response.message, "info")   
                }else{
                  // alert('excelente');
                    swal("Excelente!", response.message, "success").then((value) => {
                        mailLogin.value = '';
                        passwordLogin.value = '';
                        window.location.reload();
                    })
                }
            }
        )
        .catch( error => swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )
        //.catch( error => console.log( error ) )

    }else{

        // var form = $( "#form" );
        // form.valid();
        swal( "Error!", "Debe llenar los campos Obligatorios", "info" ); 
    
    }
    
}



function table(){
 
    var container = document.getElementById( 'container-table' );
    var code = document.getElementById( 'code' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_category.php';
    var formData = new FormData();

    formData.append( 'request', 'table' );
    formData.append( 'id', code.value );
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

function save_user(){

    var mailRegister = document.getElementById( 'mailRegister' )
    var userRegister = document.getElementById( 'userRegister' )
    var passwordRegister = document.getElementById( 'passwordRegister' )


    if( mailRegister.value !== '' && userRegister.value !== '' && passwordRegister.value != '' ){

        var url = 'http://localhost/commerce/PAGE/API/API_user.php';
        var formData = new FormData();
        formData.append( 'request', 'save' );
        formData.append( 'name', '' );
        formData.append( 'surname', '' );
        formData.append( 'user', userRegister.value );
        formData.append( 'mail', mailRegister.value );
        formData.append( 'password', passwordRegister.value );
        formData.append( 'rol', 2 );

        fetch( url, {
            method: 'POST', 
            body: formData,
        } )
        .then( response => response.json() )
        .then( 
            response => {
                if( response.status !== true ){
                    //alert( "error" );
                    //console.log( response )
                    swal("Error!", response.message, "info")   
                }else{
                  //  alert('excelente');
                    swal("Excelente!", response.message, "success").then((value) => {
                        mailRegister.value = '';
                        userRegister.value = '';
                        passwordRegister.value = '';
                        window.location.reload();
                        // document.querySelector('.lbl-register').style.transform = 'scale(.6)';

                        //table();
                    })
                }
            }
        )
        .catch( error => swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )
        //.catch( error => console.log( error ) )

    }else{

        // var form = $( "#form" );
        // form.valid();
        swal( "Error!", "Debe llenar los campos Obligatorios", "info" ); 
    
    }
    
}


function select( category ){
    var data = '';
    var url = 'http://localhost/commerce/SYSTEM/API/API_category.php';
    var code = document.getElementById( 'code' );
    var name = document.getElementById( 'name' );
    var description = document.getElementById( 'description' );
    var formData = new FormData();

    formData.append( 'request', 'select' );
    formData.append( 'id', category );

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
                name.value = data.cat_name,
                description.value = data.cat_description,
                code.value = data.cat_id,
                table(),
                changeButtons( 2 )
                //console.log( data )
            }
        }    
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

}



function updateDataUser(){

    var code = document.getElementById( 'code' )
    var name = document.getElementById( 'name' )
    var surname = document.getElementById( 'surname' )
    var password = document.getElementById( 'password' )
    var mail = document.getElementById( 'mail' )


    if( name.value !== '' && surname.value !== '' && password.value !== '' && mail.value !== '' ){
        
        var url = 'http://localhost/commerce/PAGE/API/API_user.php';

        var formData = new FormData();
        formData.append( 'request', 'updateDataUser' );
        formData.append( 'code', code.value );
        formData.append( 'name', name.value );
        formData.append( 'surname', surname.value );
        formData.append( 'password', password.value );
        formData.append( 'mail', mail.value );


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
        
                    })
                }
            }
            
        )
        .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    }else{

        // var form = $( "#form" );
        // form.valid();
        swal( "Error!", "Debe llenar los campos Obligatorios", "info" ); 
    
    }

}



function delete_( category ){


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
                var url = 'http://localhost/commerce/SYSTEM/API/API_category.php';
                var formData = new FormData();

                formData.append( 'request', 'delete' );
                formData.append( 'id', category );

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

function picture( category ) {
 
    inpfile = document.getElementById( "image" );
    inpfile.click();
    var code = document.getElementById( 'code' );
    code.value = category;

}

function chargeImage(){

    var fileField = document.querySelector("input[type='file']");
    var code = document.getElementById( 'code' );

    var url = 'http://localhost/commerce/SYSTEM/API/API_picture_category.php';
    var formData = new FormData();

    formData.append( 'image', fileField.files[0] );
    formData.append( 'category', code.value );
    formData.append( 'type', 1 );


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
                    window.location.href = "edit_picture.php?codeImage=" + response.codeImage + "&category=" + code.value + "&type=" + 1;
                })
            }
        }
    )
    .catch( error => swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

    
   
}


function table_pictures_category( category ){
    
    openModal();
    container = document.getElementById( 'modal' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_category.php';
    var formData = new FormData();

    formData.append( 'request', 'table_pictures_category' );
    formData.append( 'category', category );
    formData.append( 'type', 1 );
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