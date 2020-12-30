//******************************************************************************
//
//
//
//  #GLOBAL
//
//
//
//******************************************************************************

/* jshint ignore:start */
var global = new function() {
    this.body = document.getElementsByTagName('body');
    this.html = document.getElementsByTagName('html');
    this.animationEnd = animationEnd();
    this.transitionEnd = transitionEnd();
};

var site = new function() {
    this.url = '';
};

var paths = new function() {
    this.assets = site.url + '/assets';
    this.images = this.assets + '/images';
    this.scripts = this.assets + '/scripts';
    this.styles = this.assets + '/styles';
    this.svgs = this.assets + '/svgs';
    this.videos = this.assets + '/videos';
};
/* jshint ignore:end */
