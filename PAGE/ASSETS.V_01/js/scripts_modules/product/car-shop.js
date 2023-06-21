window.addEventListener( 'load',()=>{   
    var getCarShop = localStorage.getItem( "dataCarShop" );
    if( getCarShop !== null ){
        viewCarrShop()
        countItems()
    }
    
} );

function countItems(){
    var getCarShop = localStorage.getItem( "dataCarShop" )
    var JsonArrDecode = JSON.parse( getCarShop ).length
    var count_items = document.getElementById( "count-items" )
    if( count_items ){
        count_items.innerHTML = JsonArrDecode
    }
}

function viewCarrShop(){

    var containerItemsCarShop = document.getElementById( "container-items-car-shop" );
    var getCarShop = localStorage.getItem( "dataCarShop" );
    var structure_li = '';

    if( getCarShop !== null && getCarShop !== '[]'){
        var JsonArrDecode = JSON.parse( getCarShop );
        // console.log( JsonArrDecode[0].quantity );
        for( var i = 0; i < JsonArrDecode.length; i++ ){
            structure_li += `
                <li>
                    <div class="li-panel-img">
                        <img src="${ JsonArrDecode[ i ].pro_image }" alt="" srcset="">
                    </div>
                    <div class="li-panel-content">
                        <input type="hidden" value="${ JsonArrDecode[ i ].pro_id }" class="codeProductCar">
                        <a title="Ir al Producto" target="_blank" href="http://localhost/commerce/PAGE/PAGES/view-product.php?code=${ JsonArrDecode[ i ].pro_id }">
                            <h4>${ JsonArrDecode[ i ].pro_name }</h4>
                        </a>
                        <h5>${ JsonArrDecode[ i ].pro_price }</h5>
                        <div class="btn-count">
                            <button class="btn-minus" onclick="moreProduct( ${ JsonArrDecode[ i ].pro_id }, ${ i } , this.parentNode )";> <i class="fa fa-solid fa-plus"></i> </button>
                            <input type="number" class="quantity" disabled="" value="${ JsonArrDecode[ i ].quantity }" placeholder="${ JsonArrDecode[ i ].quantity }" >
                            <button class="btn-more" onclick="minusProduct( ${ JsonArrDecode[ i ].pro_id }, ${ i } , this.parentNode )"; > <i class="fa fa-solid fa-minus"></i> </button>
                        </div>
                    </div>
                </li>
            `;
        }
    }else{
        structure_li = `<div id="alert-car-shop" class="alert-info" style="width:80%">No se han agregado productos al carrito</div>`;
    }
    

    containerItemsCarShop.innerHTML = structure_li;
    calculateTotal()


}

function calculateTotal(){
    //calculate total
    var getCarShop = localStorage.getItem( "dataCarShop" );

    if( getCarShop ){
        var JsonArrDecode = JSON.parse( getCarShop )
        var ElementTotal = document.getElementById( "total" )
        var quantityAllElements = document.getElementsByClassName( "quantity" )
        var totalAux = 0
        var total = 0
        for( var i = 0; i < JsonArrDecode.length; i++ ){
    
            totalAux = parseInt( JsonArrDecode[ i ].pro_price ) * parseInt( quantityAllElements[ i ].value ) 
            total += totalAux;
    
        }
    }else{
        total = 0;
    }
   

    ElementTotal.innerHTML = '$.' + total

    localStorage.setItem( "total", total );
   // console.log( total )
} 


function addToCarrShop(){

    var containerItemsCarShop = document.getElementById( "container-items-car-shop" );
    var codeProduct = document.getElementById( "codeProduct" );
    //make a comparation with other elements
    var productsCar = document.getElementsByClassName( "codeProductCar" );
    var boolAddProduct = true;
    //console.log( productsCar );
    if( productsCar !== null ){
        for( var i = 0; i < productsCar.length; i++ ){
            if( codeProduct.value == productsCar[ i ].value ){
                boolAddProduct = false
                swal("Producto Agregado!", "Este producto ya ha sido agregado al carrito", "info")   
                return
            }
        }
    }


    if( boolAddProduct ){

        var quantity = document.getElementById( "quantity" );
        var url = 'http://localhost/commerce/PAGE/API/API_car_shop.php';
        var formData = new FormData();

        formData.append( 'request', 'get_product_by_id' );
        formData.append( 'id', codeProduct.value );
        formData.append( 'quantity', quantity.value );

        formData.append( 'category', '' );
        formData.append( 'subcategory', '' );
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
                //console.log( response )
                if( response.status !== true ){
                    swal("Error!", response.message, "info")   
                }else{
                    var alertCarShop = document.getElementById( "alert-car-shop")
                    if( alertCarShop !== null ){
                        containerItemsCarShop.innerHTML = '';
                    }
                    dataProduct = response.data
                    // console.log( response.data );
                    var list = document.createElement( 'li' )
                    //insert quantity of buy product
                    itemCarShop = generateItemCarShop( dataProduct )
                    list.innerHTML = itemCarShop
                    containerItemsCarShop.appendChild( list )

                    countItems() 
                    calculateTotal( )

                }

            }
        ).then(
            view_shopping_cart()
        ).catch( error =>  console.log( error ) )

    }
    
}


function generateItemCarShop( dataProduct ){
    //generate json in localstorage
    var arrJson = [];
    var objectJson = dataProduct;
    //save in localstorage
    var getCarShop = localStorage.getItem( "dataCarShop" );
   // console.log( getCarShop )
    if( getCarShop !== null ){
    
        var JsonArrDecode = JSON.parse( getCarShop );
    
        for( var i = 0; i < JsonArrDecode.length; i++ ){
    
            arrJson.push( JsonArrDecode[ i ] );

        }

        arrJson.push( objectJson );

        localStorage.setItem( "dataCarShop", JSON.stringify( arrJson ) );
        getCarShop = localStorage.getItem( "dataCarShop" );
        
        //console.log( arrJson );
    }else{

        arrJson.push( objectJson );
        localStorage.setItem( "dataCarShop", JSON.stringify( arrJson ) );
        getCarShop = localStorage.getItem( "dataCarShop" );
    }

    var JsonArrDecode = JSON.parse( getCarShop );
    var position =  JsonArrDecode.length - 1;

    var structure_li = `
            <div class="li-panel-img">
                <img src="${ dataProduct.pro_image }" alt="" srcset="">
            </div>
            <div class="li-panel-content">
                <input type="hidden" value="${ dataProduct.pro_id }" class="codeProductCar">
                <a title="Ir al Producto" target="_blank" href="http://localhost/commerce/PAGE/PAGES/view-product.php?code=${ dataProduct.pro_id }">
                <h4>${ dataProduct.pro_name }</h4>
                </a>
                <h5>${ dataProduct.pro_price }</h5>
                <div class="btn-count">
                    <button class="btn-minus" onclick="moreProduct( ${ dataProduct.pro_id }, ${ position } , this.parentNode )";> <i class="fa fa-solid fa-plus"></i> </button>
                    <input type="number" class="quantity" disabled="" value="${ dataProduct.quantity }" placeholder="${ dataProduct.quantity }" >
                    <button class="btn-more" onclick="minusProduct( ${ dataProduct.pro_id }, ${ position } , this.parentNode )"; > <i class="fa fa-solid fa-minus"></i> </button>
                </div>
            </div>
    `;



    return structure_li;
    
}

function moreProduct( codeProduct, positionJson, element ){
    
    var url = 'http://localhost/commerce/PAGE/API/API_car_shop.php';
    var formData = new FormData();
    var quantityAux = element.childNodes[ 3 ].value;

    quantityAux++;
    // console.log( quantityAux );
    formData.append( 'request', 'validate_stock' );
    formData.append( 'id', codeProduct );
    formData.append( 'quantity', quantityAux );
    formData.append( 'category', '' );
    formData.append( 'subcategory', '' );
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
                swal("Lo sentimos!", response.message, "info")   
            }else{
                var getCarShop = localStorage.getItem( "dataCarShop" );

                if( getCarShop !== null ){

                    var JsonArrDecode = JSON.parse( getCarShop )
                    console.log( JsonArrDecode )
                    var quantityMore = JsonArrDecode[ positionJson ].quantity
                    quantityMore++
                    element.childNodes[ 3 ].value = quantityMore;
                    JsonArrDecode[ positionJson ].quantity = quantityMore
                    localStorage.setItem( "dataCarShop", JSON.stringify( JsonArrDecode ) )

                    calculateTotal()
                    countItems() 

                }
            }

        }

    ).catch( error =>  console.log( error ) )

}

function minusProduct( codeProduct, positionJson, element ){

    var getCarShop = localStorage.getItem( "dataCarShop" );
    
    if( getCarShop !== null ){

        var JsonArrDecode = JSON.parse( getCarShop )
        //console.log(JsonArrDecode[ positionJson ])
        var quantityMinus = JsonArrDecode[ positionJson ].quantity
        quantityMinus--
        if( quantityMinus < 1 ){

            var nodoParent = document.getElementById( "container-items-car-shop" )
            var nodoToDelete = element.parentNode.parentNode
            nodoParent.removeChild( nodoToDelete )
            
            JsonArrDecode.splice( positionJson, 1 );
            localStorage.setItem( "dataCarShop", JSON.stringify( JsonArrDecode ) );
            
            viewCarrShop()


        }else{
            element.childNodes[ 3 ].value = quantityMinus;
            JsonArrDecode[ positionJson ].quantity = quantityMinus
            localStorage.setItem( "dataCarShop", JSON.stringify( JsonArrDecode ) );
        }

        countItems() 
        calculateTotal()

    
    }
}


function make_order(){ 
    var dataCarShop = localStorage.getItem( 'dataCarShop' ) ;
    if( dataCarShop !== null && dataCarShop !== '[]' ){
        swal({
            title: "Esta Seguro?",
            text: "Desea Realizar la Orden?",
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
                    window.location.href = '../ORDER/step_one.php';
                break;
    
                default:
                    swal("", "Accion Cancelada...", "info");
            }
        });
    }else{
        swal("Sin Productos", "Debes agregar productos para poder hacer una orden...", "info");
    }
    
}

