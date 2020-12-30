//******************************************************************************
//
//
//
//  #MEDIA QUERY
//  -> CSS media query in JavaScript
//     xs = 0
//     sm = 1
//     md = 2
//     lg = 3
//     xl = 4
//     xxl = 5
//
//     if(MediaQuery.value <= 2) {
//         DO SOMETHING
//     }
//
//
//
//******************************************************************************

(function(MediaQuery, window, document, undefined) {
    var indicator = document.createElement('div');

    indicator.className = 'js-media-query';

    document.body.appendChild(indicator);

    function getMediaQuery() {
        return parseInt(window.getComputedStyle(indicator).getPropertyValue('z-index'), 10);
    }

    MediaQuery.value = getMediaQuery();

    window.addEventListener('resize', function() {
        MediaQuery.value = getMediaQuery();
    });
}(window.MediaQuery = window.MediaQuery || {}, window, document));
