//******************************************************************************
//
//
//
//  #THEME
//
//
//
//******************************************************************************

var Theme = (function() {
    var themeCurrent;
    var themeInput;
    var themeText;

    var _addEventListeners = function() {
        themeInput.addEventListener('change', _changeTheme, false);
    };

    var _changeTheme = function(event) {
        console.log(event);
        
        if(event.target.checked) {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('kennytran-theme', 'light');
            themeText.innerHTML = 'Dark Mode';
        } else {
            document.documentElement.setAttribute('data-theme', 'default');
            localStorage.setItem('kennytran-theme', 'default');
            themeText.innerHTML = 'Light Mode';
        }  
    };

    var init = function() {
        themeCurrent = localStorage.getItem('kennytran-theme') ? localStorage.getItem('kennytran-theme') : null;
        themeInput = document.querySelector('#js-theme-toggle #js-theme-toggle-input');
        themeText = document.querySelector('#js-theme-toggle #js-theme-toggle-text');

        if(themeCurrent) {
            document.documentElement.setAttribute('data-theme', themeCurrent);

            if(themeCurrent === 'light') {
                themeText.innerHTML = 'Dark Mode';
                themeInput.checked = true;
            }
        }

        _addEventListeners();
    };

    return {
        init: init
    };
})();
