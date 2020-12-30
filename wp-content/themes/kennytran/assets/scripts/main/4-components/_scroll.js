/*******************************************************************************
//
//
//
//  #SCROLL
//
//
//
*******************************************************************************/

var Scroll = (function() {
    var container;

    var _addEventListeners = function() {
        ScrollTrigger.addEventListener('refreshInit', _setBodyHeight);
    };

    var _setBodyHeight = function() {
        document.body.style.height = container.clientHeight + 'px';
    };

    var init = function() {
        console.log('Scroll Init');

        container = document.querySelector('.c-container');

        _setBodyHeight();

        gsap.to(container, {
            ease: 'none',
            y: function() {
                return -(container.clientHeight - document.documentElement.clientHeight)
            },
            scrollTrigger: {
                trigger: document.body,
                start: 'top top',
                end: 'bottom bottom',
                invalidateOnRefresh: true,
                scrub: 0.75,
            }
        });
    };

    return {
        init: init
    };
})();
