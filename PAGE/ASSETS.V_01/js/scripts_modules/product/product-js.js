window.addEventListener( 'load', ()=>{
    get_products();

   
} );
function get_products(){

    var container_second = document.querySelector( '#container-second' );
    var category = document.getElementById( 'category' );
    var subcategory = document.getElementById( 'subcategory' );

    var url = 'http://localhost/commerce/PAGE/API/API_product.php';
    var formData = new FormData();

    formData.append( 'request', 'get_products' );
    formData.append( 'id', '' );
    formData.append( 'category', category.value );
    formData.append( 'subcategory', subcategory.value );
    formData.append( 'name', '' );
    formData.append( 'description', '' );
    formData.append( 'price', '' );
    formData.append( 'stock', '' );
    formData.append( 'situation', '' );
    formData.append( 'levelFile', '../../' );




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

                container_second.innerHTML = response.data

            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}


function get_products_more( last_id = '' ){

    var container_second = document.querySelector( '#container-second' );
    var charge = document.querySelector( '#charge' );
    var category = document.getElementById( 'category' );
    var url = 'http://localhost/commerce/PAGE/API/API_product.php';
    var formData = new FormData();
    loadingCogs( charge );

    formData.append( 'request', 'get_products' );
    formData.append( 'id', '' );
    formData.append( 'category', category.value );
    formData.append( 'subcategory', '' );
    formData.append( 'name', '' );
    formData.append( 'description', '' );
    formData.append( 'price', '' );
    formData.append( 'stock', '' );
    formData.append( 'situation', '' );
    formData.append( 'levelFile', '../../' );
    formData.append( 'last_id', last_id );

    fetch( url, {
        method: 'POST', 
        body: formData,
    } )
    .then( response => response.json() )
    .then(
        response => {
            //console.log( response )
            if( response.status !== true ){
                swal("Error!", response.message, "info")   
            }else{
                if( response.data == '' ){
                    deloadingCogs( charge, '' );
                }
                container_second.insertAdjacentHTML('beforeend', response.data );

                //container_second.innerHTML = response.data

            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}
/////scroll infinite

let block = false;
var filters = false;

window.addEventListener("scroll", async function(event) {
    const scrollHeight = this.scrollY;
    const viewportHeight = document.documentElement.clientHeight;
    const moreScroll = document.getElementById('charge').offsetTop;
    const currentScroll = scrollHeight + viewportHeight;
    if(filters === true){
        deloadingCogs( moreScroll, '' );
    }
    if((currentScroll >= moreScroll) && block === false && filters === false){
        block = true;
        this.setTimeout(() =>{
            // loadingCogs(container_charge);
            //js
            var items = document.getElementsByClassName('item');
            var last_id = items[ items.length - 1 ].getAttribute("id");
            //jquery
            // var last_id = $(".item:last").attr("id");
            //alert(last_id);
            get_products_more( last_id );
            block = false;

       }, 800);
    }
});
