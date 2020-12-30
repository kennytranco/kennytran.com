//******************************************************************************
//
//
//
//  #FUNCTIONS
//
//
//
//******************************************************************************

//******************************************************************************
//
//  #ANIMATION END
//  -> Check if animation has ended
//
//******************************************************************************

function animationEnd() {
    var element = document.createElement('element');
    var animation;

    var animations = {
        'animation'      : 'animationend',
        'OAnimation'     : 'oAnimationEnd',
        'MozAnimation'   : 'animationend',
        'WebkitAnimation': 'webkitAnimationEnd'
    };

    for(animation in animations) {
        if(element.style[animation] !== undefined) {
            return animations[animation];
        }
    }
}


//******************************************************************************
//
//  #DEBOUNCE
//  https://davidwalsh.name/javascript-debounce-function
//
//******************************************************************************

function debounce(func, wait, immediate) {
    var timeout;

    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;

            if(!immediate) {
                func.apply(context, args);
            }
        };

        var callNow = immediate && !timeout;

        clearTimeout(timeout);

        timeout = setTimeout(later, wait);

        if(callNow) func.apply(context, args);
    };
}


//******************************************************************************
//
//  #DETECT IE
//  -> Detect which version of Internet Explorer
//
//******************************************************************************

function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if(msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }

    var trident = ua.indexOf('Trident/');
    if(trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');

        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }

    var edge = ua.indexOf('Edge/');
    if(edge > 0) {
        // IE 12 => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }

    return false;
}


//******************************************************************************
//
//  #REQUESTANIMATIONFRAME POLYFILL
//
//******************************************************************************

(function() {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];

    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if(!window.requestAnimationFrame) {
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };
    }

    if(!window.cancelAnimationFrame) {
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
    }
}());


//******************************************************************************
//
//  #TRANSITION END
//  -> Check if transition has ended
//
//******************************************************************************

function transitionEnd() {
    var element = document.createElement('element');
    var transition;

    var transitions = {
        'transition'      : 'transitionend',
        'OTransition'     : 'oTransitionEnd',
        'MozTransition'   : 'transitionend',
        'WebkitTransition': 'webkitTransitionEnd'
    };

    for(transition in transitions) {
        if(element.style[transition] !== undefined) {
            return transitions[transition];
        }
    }
}
