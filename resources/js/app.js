require('./bootstrap');

import 'alpinejs'

/**
 * Scroll hostizontally
 */

document.querySelector(".scroll-h").addEventListener('wheel', (e) => {
    document.querySelector(".scroll-h").scrollLeft += e.deltaY;
})



