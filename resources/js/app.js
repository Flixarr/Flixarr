require('./bootstrap');

import 'alpinejs';

document.querySelectorAll('.scroll-x').forEach(function (element, index) {
    element.addEventListener('wheel', (e) => {
        e.preventDefault()
        element.scrollLeft += (e.deltaY * 0.5)
    })
});

/**
 * Slider
 */
import Splide from '@splidejs/splide';
import URLHash from '@splidejs/splide-extension-url-hash';

window.addEventListener('createMediaBackdropSlider', event => {
    var divId = event.detail.divId
    var options = event.detail.options
    var media = event.detail.media

    var splide = new Splide(divId, options).mount();

    media.forEach(function (item) {
        var backdrop_path = item.backdrop_path
        var title = (item.title || item.name)
        var date = (item.release_date || item.first_air_date || '0000')

        splide.add('' +
            '<li class="splide__slide rounded-lg overflow-hidden"> ' +
            '<div class="relative h-full w-full">' +
            '<img class="h-auto w-full" src="https://image.tmdb.org/t/p/w500' + backdrop_path + '" />' +
            '<div class="absolute bottom-0 top-0 flex flex-col justify-end w-full p-2 leading-4 bg-gradient-to-t via-transparent from-black">' +
            '<span class="font-bold text-gray-500 text-2xs">' + date.substring(0, 4) + '</span>' +
            '<span class="font-bold truncate">' + title + '</span>' +
            '</div>' +
            '' +
            '' +
            '</div>' +
            '</li>' +
            '')
    })
})

