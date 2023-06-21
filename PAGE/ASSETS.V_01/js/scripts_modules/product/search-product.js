function search( valueSearch ){

    setTimeout( function(){
        // alert( valueSearch );
        var result_search = document.querySelector( '#result-search' );
        if( valueSearch != '' ){

            var url = 'http://localhost/commerce/PAGE/API/API_product.php';
            var formData = new FormData();

            formData.append( 'request', 'search_products' )
            formData.append( 'name', valueSearch )

            fetch( url, {
                method: 'POST', 
                body: formData,
            } )
            .then( response => response.json() )
            .then(
                response => {
                // console.log( response )
                    if( response.status !== true ){
                        swal("Error!", response.message, "info")   
                    }else{
                        result_search.innerHTML = response.data
                        // container_second.innerHTML = response.data
                        //console.log( response.data );

                    }

                }
            )
            .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )
        }else{
            result_search.innerHTML = ''
        }
        


    }, 2000 );

}