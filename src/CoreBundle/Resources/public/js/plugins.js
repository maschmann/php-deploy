(function ($) {
    $.fn.ajaxForm = function (options) {
        var settings = $.extend({
            action: "",
            method: "",
            replaceWithData: true,
            animateLoad: true,
            onFinish: null
        }, options);

        try {
            this.submit(function (e) {
                e.preventDefault();

                //get the url for the form
                var that = $(this);

                if ("" == settings.action) {
                    settings.action = that.attr('action');
                }

                if ("" == settings.method) {
                    settings.method = that.attr('method');
                }

                if (true == settings.animateLoad) {
                    that.ajaxAnimateLoad();
                }

                $.ajax({
                    type: settings.method,
                    url: settings.action,
                    async: true,
                    data: that.serialize(),
                    success: function (data, textStatus, jqXHR) {
                        asm.log('form::response', textStatus);
                        if (true == settings.replaceWithData) {
                            that.replaceWith(data);
                        }

                        if (typeof settings.onFinish === 'function') {
                            settings.onFinish(self);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        asm.log('form::response', errorThrown);
                        that.replaceWith(jqXHR);
                        that.ajaxForm(settings);
                    }
                });
            });

            return false;
        } catch (e) {
            asm.log(e);
        }
    };
}(jQuery));

/**
 * jQuery ajax loader plugin
 */
(function ($) {
    $.fn.ajaxAnimateLoad = function (options) {
        // Create some defaults, extending them with any options that were provided
        var settings = $.extend({
            loaderImage: '/assets/images/ajax-loader.gif',
            loaderWidth: '32px',
            loaderHeight: '32px',
            fadeDuration: 200,
            action: 'start',
            backgroundDisabled: false
        }, options);

        return this.each(function () {
            var that = $(this),
                ajaxLoader = '<span id="ajaxloader" style="display: block; width: '
                    + settings.loaderWidth + '; height: '
                    + settings.loaderHeight + '; background: transparent url('
                    + settings.loaderImage
                    + ') no-repeat center center; position: absolute; top: 50%; left: 50%;">&nbsp;</span>';

            var backgroundOverlay = '<div class="modalBackgroundOverlay" style="position: fixed; width:100%; ' +
                'height: 100%; top: 0px; left: 0px; zoom: 1; opacity: 0.0; background-color: #FFF; ' +
                'z-index: 201;">&nbsp;</div>';

            if (settings.action == 'start') {
                if (true == settings.backgroundDisabled) {
                    if (that.children('.modalBackgroundOverlay').length == 0) {
                        that.append(backgroundOverlay);
                        jQuery('.modalBackgroundOverlay').animate({opacity: 0.4}, settings.fadeDuration);
                    }
                    if (that.children('#ajaxloader').length == 0) {
                        that.append(ajaxLoader);
                    }
                } else {
                    that.attr('style', 'position: relative;').append(ajaxLoader).animate({opacity: 0.4}, settings.fadeDuration);
                }
            } else if (settings.action == 'stop') {
                if (that.children('.modalBackgroundOverlay').length > 0) {
                    that.children('#ajaxloader').remove();
                    that.children('.modalBackgroundOverlay').animate({opacity: 0.0}, settings.fadeDuration).remove();
                } else {
                    that.attr('style', 'position: static;').remove("#ajaxloader").animate({opacity: 1.0}, settings.fadeDuration);
                }
            }
        });
    };
})(jQuery);

/**
 * ajax load a url into target, using loader animation
 */
(function ($) {
    $.fn.ajaxLoadElm = function (options) {

        // Create some defaults, extending them with any options that were provided
        var settings = $.extend({
                url: '',
                method: 'GET',
                data: null,
                async: true,
                animateLoad: true,
                backgroundDisabled: false,
                onSuccess: function() {}
            }, options),
            that = $(this);

        try {
            if (true == settings.animateLoad) {
                that.ajaxAnimateLoad({'backgroundDisabled': settings.backgroundDisabled});
            }

            if (null !== settings.data) {
                var data = settings.data;
            }

            asm.debug('data for ajax', data);
            $.ajax({
                type: settings.method,
                url: settings.url,
                async: settings.async,
                data: data,
                success: function (data, textStatus, jqXHR) {
                    asm.debug('ajaxLoadElm::success', textStatus);
                    that.replaceWith(data);

                    if (typeof settings.onSuccess === 'function') {
                        settings.onSuccess(self);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    asm.log('form::response', errorThrown);
                    that.replaceWith(jqXHR);
                }
            });

            return false;
        }
        catch (e) {
            asm.log('exception', e);
        }
    };
})(jQuery);
