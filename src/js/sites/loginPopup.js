'use strict'
const LoginPopup = {
    $domLoginPopup: $('.js-popup-login'),
    $domOpenAndCloseLoginPopupLink: $('.js-open-login-popup'),
    /**
     * @desc Initialize
     */
    init: function() {
        this.openPopup();
        this.closePopup();
    },

    /**
     * @desc Open Login Popup
     */
    openPopup: function() {
        let i = 1;
        LoginPopup.$domOpenAndCloseLoginPopupLink.on('click', ()=>{
            LoginPopup.$domOpenAndCloseLoginPopupLink.find('span').text('Close');
            LoginPopup.$domOpenAndCloseLoginPopupLink.css('background-color', '#f44336');
            LoginPopup.$domLoginPopup.show();
            if (i % 2 === 0) {
                LoginPopup.$domOpenAndCloseLoginPopupLink.css('background-color', '#4CAF50');
                LoginPopup.$domOpenAndCloseLoginPopupLink.find('span').text('Login');
                LoginPopup.$domLoginPopup.hide();
            }
            i++;
        });
    },

    /**
     * @desc Close Login Popup
     */
    closePopup: function() {
        $('.js-close-popup').on('click', ()=>{
            LoginPopup.$domOpenAndCloseLoginPopupLink.css('background-color', '#4CAF50');
            LoginPopup.$domOpenAndCloseLoginPopupLink.find('span').text('Login');
            LoginPopup.$domLoginPopup.hide();
        });
    }
};

// initialise on DOM ready
$(function() {
    LoginPopup.init();
});