(function ($) {
    Drupal.behaviors.capcha_keypad = {

        attach: function (data, settings) {
            jQuery(document).ready(function () {
                jQuery('.form-item-captcha-keypad-input').append(
                    '<span class="clear">' + Drupal.t('Clear') + '</span>'
                );

                jQuery('.form-item-captcha-keypad-input .clear').click(function () {
                    jQuery('#edit-captcha-keypad-input').val('');
                });

                jQuery('.captcha-keypad .inner span').click(function () {
                    var value = jQuery('#edit-captcha-keypad-input').val()
                    jQuery('#edit-captcha-keypad-input').val(value + jQuery(this).text());
                });
            })
        }
    };
})(jQuery);
