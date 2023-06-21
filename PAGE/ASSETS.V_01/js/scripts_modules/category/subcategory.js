
window.addEventListener( 'load', ()=>{
    carrousel_subcategories();
} );
function carrousel(){
    const slider = document.querySelector(".carrousel-cards");
    let sliderSection = document.querySelectorAll(".card-item");
    let sliderSectionLast = sliderSection[sliderSection.length - 1];
    slider.insertAdjacentElement('afterbegin', sliderSectionLast);
    arrow_left = document.getElementById('arrow-left');
    arrow_right = document.getElementById('arrow-right');

    arrow_right.addEventListener('click', () => {
        let sliderSectionFirst = document.querySelectorAll(".card-item")[0];
        slider.style.marginLeft = "-200%";
        slider.style.transition = "all 2s";
        setTimeout(function () {
            slider.style.transition = "none";
            slider.insertAdjacentElement('beforeend', sliderSectionFirst);
            slider.style.marginLeft = "-100%";
        }, 2000);

    });
    
    arrow_left.addEventListener('click', () => {
        let sliderSection = document.querySelectorAll(".card-item");
        let sliderSectionLast = sliderSection[sliderSection.length - 1];
        slider.style.marginLeft = "0";
        slider.style.transition = "all 2s";
        setTimeout(function () {
            slider.style.transition = "none";
            slider.insertAdjacentElement('afterbegin', sliderSectionLast);
            slider.style.marginLeft = "-100%";
        }, 2000);

    });

}

function carrousel_subcategories(){
    var codeCategory = document.getElementById( 'codeCategory' );
    var carrousel_cards = document.querySelector( '.main-one-content' );
    var carrousel_arrows_cards = document.querySelector( '.carrousel-arrows-cards' );
    var url = 'http://localhost/commerce/PAGE/API/API_subcategory.php';
    var formData = new FormData();

    formData.append( 'request', 'carrousel_subcategories' );
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
                var newElement = document.createElement("div")
                newElement.innerHTML =  response.data 
                newElement.style.width = '85%'
                newElement.style.margin = 'auto'
                newElement.style.overflow = 'hidden';

                var parentDiv = carrousel_arrows_cards.parentNode
                parentDiv.insertBefore( newElement,  carrousel_arrows_cards )
                carrousel()
            }

        }
    )
    .catch( error =>  swal( "Error!", "Ha ocurrido un error en el servidor", "warning" ) )


}

