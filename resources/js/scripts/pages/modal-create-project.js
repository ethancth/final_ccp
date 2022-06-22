$(function () {
    ('use strict');
    var createProjectForm = $('#createProjectForm');

    // jQuery Validation
    // --------------------------------------------------------------------
    if (createProjectForm.length) {
        createProjectForm.validate({
            rules: {
                modalProjectName: {
                    required: true
                }
            }
        });
    }

    // reset form on modal hidden
    $('.modal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });
});
