//******************************************************************************
//
//
//
//  #NAV
//
//
//
//******************************************************************************

var Nav = (function() {
    var _addEventListeners = function() {
        barba.hooks.before(function() {
            console.log('Nav Before');

            Header.close();

            global.html[0].classList.remove('is-page-ready');
        });

        barba.hooks.after(function() {
            console.log('Nav After');

            Scroll.init();
            Jumbotron.init();

            global.html[0].classList.add('is-page-ready');
        });
    };

    var init = function() {
        barba.init({
            transitions: [{
                name: 'default',
                leave: function(data) {
                    console.log('Nav Leave');

                    var done = this.async();

                    data.current.container.classList.add('-is-leave');

                    return gsap.fromTo(data.current.container,
                        { opacity: 1 },
                        {
                            duration: 0.75,
                            opacity: 0,
                            onComplete: function() {
                                window.scrollTo(0, 0);

                                done();

                                console.log('Nav Leave Done');
                            }
                        }
                    );
                },
                enter: function(data) {
                    console.log('Nav Enter');

                    var done = this.async();

                    data.next.container.classList.add('-is-enter');

                    return gsap.fromTo(data.next.container,
                        { opacity: 0 },
                        {
                            opacity: 1,
                            duration: 0.75,
                            onComplete: function() {
                                data.next.container.classList.remove('-is-enter');

                                //done();
                                window.location.reload();

                                console.log('Nav Enter Done');
                            }
                        }
                    );
                }
            }]
        });

        _addEventListeners();
    };

    return {
        init: init
    };
})();
