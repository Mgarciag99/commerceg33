
window.addEventListener( 'load', ()=>{
    //carrousel_categories();

    


} );

// function carrousel(){
//     const slider = document.querySelector(".carrousel-cards");
//     var sliderSection = document.querySelectorAll(".card-item");
//     var sliderSectionLast = sliderSection[ 1 ];

//     // if( ! document.body.contains( document.querySelectorAll(".card-item")[2] ) ){
//     //     var newElement = document.createElement("div")
//     //     let sliderSectionLast = sliderSection[sliderSection.length - 1];

//     //     newElement.className = "card-item";
//     //     newElement.innerHTML = sliderSectionLast.innerHTML ;
//     //     slider.append( newElement );

//     //     console.log(sliderSection);

//     // }


    

//     slider.insertAdjacentElement('afterbegin', sliderSectionLast);
//     arrow_left = document.getElementById('arrow-left');
//     arrow_right = document.getElementById('arrow-right');

//     arrow_right.addEventListener('click', () => {
//         let sliderSectionFirst = document.querySelectorAll(".card-item")[0];
//         slider.style.marginLeft = "-100%";
//         slider.style.transition = "all 2s";
//         setTimeout(function () {
//             slider.style.transition = "none";
//             slider.insertAdjacentElement('beforeend', sliderSectionFirst);
//             slider.style.marginLeft = "-0%";
//         }, 2000);
//     });
    
    
//     arrow_left.addEventListener('click', () => {

//         let sliderSection = document.querySelectorAll(".card-item");
//         let sliderCenter = sliderSection[ 0 ];
//         //console.log( sliderSection );
        
//         // let sliderSection = document.querySelectorAll(".card-item");
//         // let sliderSectionLast = sliderSection[sliderSection.length - 1];
        
//         slider.style.marginLeft = "0%";
//         slider.style.transition = "all 2s";
//         setTimeout(function () {
//             slider.style.transition = "none";
//             sliderSection[ 1 ].insertAdjacentElement('beforebegin', sliderCenter );
//             //slider.style.marginLeft = "0%";
//         }, 2000);

//     });
// }




function carrousel( total_items ){

    arrow_left = document.getElementById('arrow-left');
    arrow_right = document.getElementById('arrow-right');

    var sliderSection = document.querySelectorAll(".card-item");
    var sliderSectionFirst = sliderSection[0];

    if( ! document.body.contains( document.querySelectorAll(".card-item")[2] ) ){

        var newElement = document.createElement("div")
        var sliderSectionLast = sliderSection[sliderSection.length - 1];
        newElement.className = "card-item";
        newElement.id = "new";

        var parentDiv = sliderSectionFirst.parentNode
        parentDiv.insertBefore( newElement,  sliderSectionFirst )
        newElement.innerHTML = sliderSectionLast.innerHTML;

    }
    
    ///correccion si solamente existen dos items

    if( total_items == 2 ){

        arrow_right.addEventListener('click', () => {
            var slider = document.querySelector(".carrousel-cards");
            var sliderSection = document.querySelectorAll(".card-item");
            var sliderCenter = sliderSection[1];
    
            slider.style.marginLeft = "-200%";
            slider.style.transition = "all 2s";
            setTimeout(function () {
                slider.style.transition = "none";
                slider.insertAdjacentElement('beforeend', sliderCenter);
                slider.style.marginLeft = "-100%";
            }, 2000);
    
        });
        
        arrow_left.addEventListener('click', () => {
            var slider = document.querySelector(".carrousel-cards");
            var sliderSection = document.querySelectorAll(".card-item");
            var sliderCenter = sliderSection[1];
    
            slider.style.marginLeft = "0%";
            slider.style.transition = "all 2s";
            setTimeout(function () {
                slider.style.transition = "none";
                slider.insertAdjacentElement('afterbegin', sliderCenter);
                slider.style.marginLeft = "-100%";
            }, 2000);
    
        });

    }


}

function carrousel_categories(){

    var carrousel_arrows_cards = document.querySelector( '.carrousel-arrows-cards' );
 //   var carrousel_cards = document.querySelector( '.carrousel-cards' );
    var url = 'http://localhost/commerce/PAGE/API/API_category.php';
    var formData = new FormData();

    formData.append( 'request', 'carrousel_categories' );

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
                var newElement = document.createElement("div")
                newElement.innerHTML =  response.data 
                //console.log( newElement )
                newElement.style.width = '85%'
                newElement.style.margin = 'auto'
                newElement.style.overflow = 'hidden';

                var parentDiv = carrousel_arrows_cards.parentNode
                parentDiv.insertBefore( newElement,  carrousel_arrows_cards )
                //carrousel_cards.innerHTML = response.data
                var total_items = parseInt( document.getElementById( 'total-items' ).value );

                carrousel( total_items )
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}


function carrousel_categories(){

    var carrousel_arrows_cards = document.querySelector( '.carrousel-arrows-cards' );
 //   var carrousel_cards = document.querySelector( '.carrousel-cards' );
    var url = 'http://localhost/commerce/PAGE/API/API_category.php';
    var formData = new FormData();

    formData.append( 'request', 'carrousel_categories' );

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
                var newElement = document.createElement("div")
                newElement.innerHTML =  response.data 
                //console.log( newElement )
                newElement.style.width = '85%'
                newElement.style.margin = 'auto'
                newElement.style.overflow = 'hidden';

                var parentDiv = carrousel_arrows_cards.parentNode
                parentDiv.insertBefore( newElement,  carrousel_arrows_cards )
                //carrousel_cards.innerHTML = response.data
                var total_items = parseInt( document.getElementById( 'total-items' ).value );

                carrousel( total_items )
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}


function list_categories(){
    
       var container_list = document.querySelector( '#container-list' );
       var url = 'http://localhost/commerce/PAGE/API/API_category.php';
       var formData = new FormData();
   
       formData.append( 'request', 'list_categories' );
   
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
                   container_list.innerHTML = response.data
                   view_categories()
               }
   
           }
       )
       .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

}


function list_subcategories( category, nameCategory ){
    var container_list_subcategories = document.querySelector( '.container-list-subcategories' );
    var url = 'http://localhost/commerce/PAGE/API/API_subcategory.php';
    var formData = new FormData();

    formData.append( 'request', 'list_categories' );
    formData.append( 'codeCategory', category );


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
                var title_category = document.getElementById( 'title-category' )
                title_category.innerHTML = nameCategory
                container_list_subcategories.innerHTML = response.data
                view_subcategories()
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )

}