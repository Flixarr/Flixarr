require('./bootstrap');

import 'alpinejs'


/**
 * Components
 */
// import './components/modal';

var mouseWheelEvt = function (event) {
    console.log(event);
    // if (document.d.doScroll)
    //     document.d.doScroll(event.wheelDelta > 0 ? "left" : "right");
    // else if ((event.wheelDelta || event.detail) > 0)
    //     document.d.scrollLeft -= 10;
    // else
    //     document.d.scrollLeft += 10;

    // return false;
}

var scrollDivs = document.getElementsByClassName('.scroll-h');
for (var i = 0; i < scrollDivs.length; i++) {
    scrollDivs[i].addEventListener("mousewheel", mouseWheelEvt);
}



