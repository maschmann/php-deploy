(function ($) {
    window.asm.dashboard = window.asm.dashboard || {};
    asm.dashboard = {

        baseUrl: asm.utility.getBaseUrl(),

        init: function () {
            asm.info('initialized asm.dashboard');

            var deploymentsTable = $('#deployments-table');

            if (deploymentsTable.length > 0) {
                asm.dashboard.initTable(deploymentsTable);
            }
        },

        initTable: function (deploymentsTable) {
            asm.info('called initTable');

            deploymentsTable.ajaxLoadElm({
                url: deploymentsTable.data('link'),
                method: 'GET',
                animateLoad: true,
                backgroundDisabled: false,
                data: {
                    amount: 20
                }
            });
        }
    }

})(jQuery);

asm.utility.documentReady(asm.dashboard.init());
