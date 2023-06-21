function loadingBtn(elemento){
	elemento.innerHTML = '<i id="loading-btn" class="fa fas fa-spinner fa-pulse fa-2x"></i>';
	elemento.setAttribute("disabled","disabled");
}	

function deloadingBtn(elemento,txthtml){
	elemento.innerHTML = txthtml;
	elemento.removeAttribute("disabled");
}

// function loadingDiv(elemento){
// 	elemento.innerHTML = '<img class="img-loading-div" src="../../CONFIG/images/loading.gif" width="20%" alt="">';
// }

// function deloadingDiv(elemento,txthtml){
// 	elemento.innerHTML = txthtml;
// }

function loadingCogs(elemento){
	elemento.innerHTML = '<br><div id="loading" style="text-align: center;"><i class="fa fas fa-cog fa-pulse fa-2x"></i></div>';
}

function deloadingCogs(elemento,txthtml){
	elemento.innerHTML = txthtml;
}


function view_shopping_cart(){
    const elementdiv = document.querySelector( '.overlay-panel' )
    const style = getComputedStyle( elementdiv )

	if ( style.display === 'none' ) {
        document.querySelector( '.overlay-panel').style.display = "flex";
        document.querySelector( '#panel').style.display = "block";      


        document.querySelector( '#panel').style.animation= "open-panel ease 1.5s backwards";
    
    } else if ( style.display === 'flex' ) {  
        document.querySelector( '.overlay-panel').style.display = "none";
        document.querySelector( '#panel').style.display = "none";               
    }
}



function view_categories(){
    const elementdiv = document.querySelector( '.overlay-panel-second' )
    const style = getComputedStyle( elementdiv )

	if ( style.display === 'none' ) {
        document.querySelector( '.overlay-panel-second').style.display = "flex";
        document.querySelector( '#panel-second').style.display = "block";      


        document.querySelector( '#panel-second').style.animation= "open-panel ease 1.5s backwards";
    
    } else if ( style.display === 'flex' ) {  
        document.querySelector( '.overlay-panel-second').style.display = "none";
        document.querySelector( '#panel-second').style.display = "none";               
    }
}



function view_subcategories(){
    const elementdiv = document.querySelector( '.overlay-panel-three' )
    const style = getComputedStyle( elementdiv )

	if ( style.display === 'none' ) {
        document.querySelector( '.overlay-panel-three').style.display = "flex";
        document.querySelector( '#panel-three').style.display = "block";      


        document.querySelector( '#panel-three').style.animation= "open-panel ease 1.5s backwards";
    
    } else if ( style.display === 'flex' ) {  
        document.querySelector( '.overlay-panel-three').style.display = "none";
        document.querySelector( '#panel-three').style.display = "none";               
    }
}
