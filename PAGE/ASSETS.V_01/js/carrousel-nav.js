window.addEventListener('load', () => {
    //////////////////////////////////////////////////////////
    ////////////////////HEADER////////////////////////////////
    //////////////////////////////////////////////////////////

    const slider = document.querySelector(".carrousel-images");
    let sliderSection = document.querySelectorAll(".img");
    let sliderSectionLast = sliderSection[sliderSection.length - 1];
    slider.insertAdjacentElement('afterbegin', sliderSectionLast);

    //content-carrousel
    const content = document.querySelector("#content-carrousel");
    let contenSection = document.querySelectorAll(".item-1");
    let contentSectionLast = contenSection[contenSection.length - 1];
    content.insertAdjacentElement('afterbegin', contentSectionLast);

    arrow_left = document.getElementById('arrow-left');
    arrow_right = document.getElementById('arrow-right');
    var imagenes = document.getElementsByClassName('img');

    setInterval(() => {
        let sliderSectionFirst = document.querySelectorAll(".img")[0];
        slider.style.marginLeft = "-200%";
        slider.style.transition = "all 2s";
        let sliderContentFirst = document.querySelectorAll(".item-1")[0];
        content.style.marginLeft = "-200%";
        content.style.transition = "all 2s";
        setTimeout(function () {
            slider.style.transition = "none";
            slider.insertAdjacentElement('beforeend', sliderSectionFirst);
            slider.style.marginLeft = "-100%";
            content.style.transition = "none";
            content.insertAdjacentElement('beforeend', sliderContentFirst);
            content.style.marginLeft = "-100%";
        }, 2000);
    }, 5000);

    arrow_right.addEventListener('click', () => {
        let sliderSectionFirst = document.querySelectorAll(".img")[0];
        slider.style.marginLeft = "-200%";
        slider.style.transition = "all 2s";
        let sliderContentFirst = document.querySelectorAll(".item-1")[0];
        content.style.marginLeft = "-200%";
        content.style.transition = "all 2s";
        setTimeout(function () {
            slider.style.transition = "none";
            slider.insertAdjacentElement('beforeend', sliderSectionFirst);
            slider.style.marginLeft = "-100%";
            content.style.transition = "none";
            content.insertAdjacentElement('beforeend', sliderContentFirst);
            content.style.marginLeft = "-100%";
        }, 2000);

    });
    
    arrow_left.addEventListener('click', () => {
        let sliderSection = document.querySelectorAll(".img");
        let sliderSectionLast = sliderSection[sliderSection.length - 1];
        slider.style.marginLeft = "0";
        slider.style.transition = "all 2s";
        let sliderContent = document.querySelectorAll(".item-1");
        let sliderContentLast = sliderContent[sliderContent.length - 1];
        content.style.marginLeft = "0";
        content.style.transition = "all 2s";
        setTimeout(function () {
            slider.style.transition = "none";
            slider.insertAdjacentElement('afterbegin', sliderSectionLast);
            slider.style.marginLeft = "-100%";
            content.style.transition = "none";
            content.insertAdjacentElement('afterbegin', sliderContentLast);
            content.style.marginLeft = "-100%";
        }, 2000);

    });

});
