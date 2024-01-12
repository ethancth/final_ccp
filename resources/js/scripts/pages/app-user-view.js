
(function () {


    var formChangePassword = $('#formChangePassword');

    if (formChangePassword.length) {
        formChangePassword.validate({
            rules: {
                newPassword: {
                    required: true,
                    minlength: 8
                },
                confirmPassword: {
                    required: true,
                    minlength: 8,
                    equalTo: '#newPassword'
                }
            },
            messages: {
                newPassword: {
                    required: 'Enter new password',
                    minlength: 'Enter at least 8 characters'
                },
                confirmPassword: {
                    required: 'Please confirm new password',
                    minlength: 'Enter at least 8 characters',
                    equalTo: 'Password mismatch'
                }
            }
        });
    }
})();
