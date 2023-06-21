function changeButtons( btn ){

    var save = document.getElementById( 'save' );
    var update = document.getElementById( 'update' );

    if( btn == 1 ){

        save.classList.remove( 'hidden' );
        update.classList.add( 'hidden' );

    }else if( btn == 2 ){

        save.classList.add( 'hidden' );
        update.classList.remove( 'hidden' );

    }

}