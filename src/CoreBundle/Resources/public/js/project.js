(function ($) {

    window.asm.project = window.asm.project || {};

    asm.project = {

        baseUrl: asm.utility.getBaseUrl(),

        init: function () {
            asm.info('asm.project init');

            if ($('.asm-edit-btn').length > 0) {
                asm.project.initEditButtons();
            }

            if ($('.asm-delete-btn').length > 0) {
                asm.project.initDeleteButtons();
            }

            if ($('.asm-create-btn').length > 0) {
                asm.project.initAddButton();
            }

            if ($('.asm-deploy-btn').length > 0) {
                asm.project.initDeployButton();
            }
        },

        initEditButtons: function () {
            $('.asm-edit-btn').click(function (e) {
                var formUrl = $(this).data('link');
                asm.debug('formUrl', formUrl);

                asm.modal.init({
                    url: formUrl,
                    onClose: function () {
                        asm.project.reloadList();
                    },
                    success: function () {
                        $('#project-form').ajaxForm();
                    }
                });
            });
        },

        initAddButton: function () {
            $('.asm-create-btn').click(function (e) {
                var formUrl = $(this).data('link');
                asm.modal.init({
                    url: formUrl,
                    width: 550,
                    resizable: true,
                    onClose: function () {
                        asm.project.reloadList();
                    },
                    success: function () {
                        $('#project-form').ajaxForm();
                    }
                });
            });
        },

        initDeployButton: function () {
            $('.asm-deploy-btn').click(function (e) {
                var deployUrl = $(this).data('link');
                asm.modal.init({
                    url: deployUrl,
                    width: 550,
                    resizable: true,
                    onClose: function () {
                        asm.project.reloadList();
                    },
                    success: function () {
                    }
                });
            });
        },

        initDeleteButtons: function () {
            $('.asm-delete-btn').click(function (e) {
                var confirmed = confirm(asm.project.confirm_delete);
                if (confirmed == true) {

                    var postData = {
                        key: $(this).data('id')
                    };

                    $.ajax({
                        type: 'POST',
                        url: $(this).data('link'),
                        data: postData,
                        success: function (data, textStatus, jqXHR) {
                            asm.log('delete::response', textStatus);
                            asm.project.reloadList();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            asm.log('delete::response', errorThrown);
                        }
                    });
                }
            });
        },

        reloadList: function () {
            asm.debug('fired reload with settings', settings);
            $('#asm-projects-list').ajaxLoadElm({
                source: $('#asm-projects').data('link'),
                type: 'POST',
                onSuccess: function () {
                    asm.project.initEditButtons();
                    asm.project.initDeleteButtons();
                }
            });
        }
    }
})(jQuery);

asm.utility.documentReady(asm.project.init());
