require('./bootstrap');

import 'alpinejs'

/* ------------------- */
/* Scroll horizontally */
/* ------------------- */

document.querySelectorAll('.scroll-x').forEach(function (element, index) {
    element.addEventListener('wheel', (e) => {
        element.scrollLeft += (e.deltaY * 0.5)
    })
});

/* ------------------- */
