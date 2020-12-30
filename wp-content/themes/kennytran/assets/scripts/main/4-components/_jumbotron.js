//******************************************************************************
//
//
//
//  #JUMBOTRON
//
//
//
//******************************************************************************

var Jumbotron = (function() {
    var Jumbotron = function(element) {
        this.jumbotron = element;
        this.jumbotronHeight = this.jumbotron.offsetHeight;
        this.jumbotronStatement = this.jumbotron.querySelector('.c-jumbotron__statement');

        this._setup();
    };

    Jumbotron.prototype = {
        _setup: function() {
            var _self = this;

            _self._addEventListeners();
        },

        _addEventListeners: function() {
            var _self = this;

            window.addEventListener('scroll', function() {
                var scrollTop =  window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

                _self._setOpacity(scrollTop);
                _self._setPointerEvents(scrollTop);
            });
        },

        _setOpacity: function(scrollTop) {
            var _self = this;

            var opacity = 1 - (scrollTop / (_self.jumbotronHeight / 2));

            if(opacity <= 0) { opacity = 0; }

            _self.jumbotron.style.opacity = opacity;

            if(scrollTop >= (_self.jumbotronHeight / 2)) {
                _self.jumbotron.classList.add('-is-no-pointer');
            } else {
                _self.jumbotron.classList.remove('-is-no-pointer');
            }
        },

        _setPointerEvents: function(scrollTop) {
            var _self = this;

            if(scrollTop >= (_self.jumbotronHeight / 2)) {
                _self.jumbotron.classList.add('-is-no-pointer');
            } else {
                _self.jumbotron.classList.remove('-is-no-pointer');
            }
        },
    };

    var init = function() {
        console.log('Jumbotron Init');

        var jumbotronElements = document.querySelectorAll('.c-jumbotron');

        Array.prototype.forEach.call(jumbotronElements, function(jumbotronElement) {
            var instance = jumbotronElement.getAttribute('data-jumbotron');

            if(!instance) {
                jumbotronElement.setAttribute('data-jumbotron', new Jumbotron(jumbotronElement));
            }
        });
    };

    return {
        init: init
    };
})();
