//******************************************************************************
//
//
//
//  #MAIN
//
//
//
//******************************************************************************

var fontDin = new FontFaceObserver('din-condensed');
var fontHeebo = new FontFaceObserver('heebo');
var fontInconsolata = new FontFaceObserver('Inconsolata');

Promise.all([
    fontDin.load(null, 5000),
    fontHeebo.load(null, 5000),
    fontInconsolata.load(null, 5000),
]).then(function() {
    global.html[0].classList.remove('is-dom-loading');
});

window.onload = function(event) {
    Theme.init();
    Scroll.init();

    // Go to top of page
    window.onbeforeunload = function() {
        window.scrollTo(0, 0);
    };

    // Prevent animations and transitions on window resize
    var timerWindowResize;

    window.addEventListener('resize', function() {
        global.html[0].classList.add('is-disable-animations');
        
        clearTimeout(timerWindowResize);
        
        timerWindowResize = setTimeout(function() {
            global.html[0].classList.remove('is-disable-animations');
        }, 400);
    });

    Header.init();
    Nav.init();
    Jumbotron.init();
    CopyToClipboard.init();

    global.html[0].classList.add('is-page-ready');
};
