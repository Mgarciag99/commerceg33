function openModal(){
    const elementdiv = document.querySelector( '.overlay' )
    const style = getComputedStyle( elementdiv )
    //  console.log(style.display);
    if ( style.display === 'none' ) {
        document.querySelector( '.overlay').style.display = "flex";             
        document.querySelector( '#modal').style.animation= "open-modal ease 1.5s backwards";
    
    } else if ( style.display === 'flex' ) {             
        document.querySelector( '#modal' ).style.animation= "close-modal ease 1.5s backwards";
        document.querySelector( '.overlay' ).style.display = "none";
    }


}