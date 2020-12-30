//******************************************************************************
//
//
//
//  #COPY TO CLIPBOARD
//
//
//
//******************************************************************************

var CopyToClipboard = (function() {
    var buttons;

    var _addEventListeners = function() {
        buttons.forEach(function(button) {
            var input = document.createElement('input');

            input.setAttribute('type', 'text');
            input.setAttribute('value', 'kenny@kennytran.com');

            button.addEventListener('click', function(event) {
                input.select();
                input.setSelectionRange(0, 99999);

                document.execCommand('copy');

                alert('Copied ' + input.value + ' to clipboard');
            });
        });
    };

    var init = function() {
        buttons = document.querySelectorAll('.js-copy-to-clipboard-button');

        _addEventListeners();
    };

    return {
        init: init
    };
})();
