

$(function () {
  'use strict';

  var pageResetPasswordForm = $('.auth-reset-password-form');

  // jQuery Validation
  // --------------------------------------------------------------------
  if (pageResetPasswordForm.length) {
    pageResetPasswordForm.validate({
      /*
      * ? To enable validation onkeyup
      onkeyup: function (element) {
        $(element).valid();
      },*/
      /*
      * ? To enable validation on focusout
      onfocusout: function (element) {
        $(element).valid();
      }, */
      rules: {
        'password': {
          required: true,
            minlength:8,
            maxlength:64
        },
        ' ': {
          required: true,
          equalTo: '#password'
        }
      }
    });
  }
});
