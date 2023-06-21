
//add event mouseover item for item
optionNav = document.getElementsByClassName("option-nav");
navbar_dragable = document.getElementsByClassName("navbar-dragable");

for( var i = 0; i < optionNav.length; i++ ){
    
    optionNav[i].addEventListener('mouseover',(e)=>{

        const idSelected = e.target.getAttribute("id");
        //style items of navbar_dragable
        const stylefirst = getComputedStyle( navbar_dragable[0] );
        const styleSecond = getComputedStyle( navbar_dragable[1] );
        const stylethird = getComputedStyle( navbar_dragable[2] );
        const stylefourt = getComputedStyle( navbar_dragable[3] );
        //no view 
        for(var i = 0; i < navbar_dragable.length; i++ ){
            navbar_dragable[i].style.display = 'none';
        }
        //with the ID determinate navbar_dragable to view
        if( stylefirst.display == 'none' && styleSecond.display == 'none' && stylethird.display == 'none' && stylefourt.display == 'none' ){
            navbar_dragable[idSelected - 1].style.display = 'block';
        }  

    });

}
