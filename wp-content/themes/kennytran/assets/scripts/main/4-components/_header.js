/*******************************************************************************
//
//
//
//  #NAV TRIGGER
//
//
//
*******************************************************************************/

var Header = (function() {
    var header;
    var isScroll;
    var nav;
    var navTrigger;
    var scrollTopLast;
    var state;

    var _addEventListeners = function() {
        navTrigger.addEventListener('click', function() {
            toggle();
        });

        window.addEventListener('resize', function() {
            close();
        });

        window.addEventListener('scroll', function() {
            isScroll = true;
        });
    };

    var close = function() {
        navTrigger.setAttribute('aria-expanded', false);
        nav.hidden = true;
    };

    var _hasScrolled = function() {
        var scrollTop =  window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
        var delta = 5;

        if(Math.abs(scrollTopLast - scrollTop) <= delta) return;

        if(scrollTop > scrollTopLast && scrollTop > delta) {
            header.classList.add('-is-hidden');
        } else {
            if((scrollTop + window.screen.height) < document.body.clientHeight) {
                header.classList.remove('-is-hidden');
            }
        }

        scrollTopLast = scrollTop;
    };

    var open = function() {
        navTrigger.setAttribute('aria-expanded', true);
        nav.hidden = false;
    };

    var toggle = function() {
        state = JSON.parse(navTrigger.getAttribute('aria-expanded'));

        navTrigger.setAttribute('aria-expanded', !state);
        nav.hidden = !nav.hidden;
    };

    var activateHeader = function() {
        header.classList.add('-is-active');
        header.removeEventListener(global.transitionEnd, activateHeader);
    };

    var init = function() {
        header = document.querySelector('.c-header');
        isScroll = false;
        nav = header.querySelector('.c-header__nav');
        navTrigger = header.querySelector('.js-header-nav-trigger');
        scrollTopLast = 0;

        setInterval(function() {
            if(isScroll) {
                _hasScrolled();

                isScroll = false;
            }
        }, 250);

        _addEventListeners();

        header.addEventListener(global.transitionEnd, activateHeader);
    };

    return {
        init: init,
        close: close,
        open: open
    };
})();
