(function ($) {
    var once = 0;
    Drupal.behaviors.capcha_keypad = {

        attach: function (data, settings) {
            jQuery(document).ready(function () {
                if (once != 0) {
                    return;
                }
                once = 1;

                jQuery('#edit-captcha-keypad-input').keyup(function() {
                    jQuery('#edit-captcha-keypad-input').val('');
                    jQuery('#edit-captcha-keypad .message').css('color', 'red');
                    jQuery('#edit-captcha-keypad .message').html(Drupal.t('Use keypad ->'));
                });

                jQuery('.form-item-captcha-keypad-input').append(
                    '<span class="clear">' + Drupal.t('Clear') + '</span><br/>' +
                    '<span class="message"></span>'
                );

                jQuery('.form-item-captcha-keypad-input .clear').click(function () {
                    jQuery('#edit-captcha-keypad-input').val('');
                    jQuery('#edit-captcha-keypad .message').html('');
                });

                jQuery('.captcha-keypad .inner span').click(function () {
                    var value = jQuery('#edit-captcha-keypad-input').val()
                    jQuery('#edit-captcha-keypad-input').val(value + jQuery(this).text());
                    jQuery('#edit-captcha-keypad .message').html('');
                });
            })
        },
        clean: function (data, settings) {
            jQuery('#edit-captcha-keypad-input').val('zz');
        }
    };
})(jQuery);
