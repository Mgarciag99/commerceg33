function list_categories(){
 
    var selectCategory = document.getElementById( 'category' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_category.php';
    var formData = new FormData();

    formData.append( 'request', 'select_category' );
    formData.append( 'id', '' );
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
                selectCategory.innerHTML = response.data
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}


function list_subcategory( category ){
    var selectSubCategory = document.getElementById( 'subcategory' );
    var url = 'http://localhost/commerce/SYSTEM/API/API_sub_category.php';
    var formData = new FormData();

    formData.append( 'request', 'select_sub_category' );
    formData.append( 'id', '' );
    formData.append( 'codeCategory', category );
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
                selectSubCategory.innerHTML = response.data
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )
}