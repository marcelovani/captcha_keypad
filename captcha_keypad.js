(function ($) {

    Drupal.behaviors.capcha_keypad = {

        attach: function (data, settings) {
            jQuery(document).ready(function () {
                jQuery('.captcha-keypad-input').keyup(function() {
                    jQuery('.captcha-keypad-input').val('');
                    jQuery('.captcha-keypad-wrapper .message').css('color', 'red');
                    jQuery('.captcha-keypad-wrapper .message').html(Drupal.t('Use keypad ->'));
                });

                jQuery('.form-item-captcha-keypad-input').append(
                    '<span class="clear">' + Drupal.t('Clear') + '</span><br/>' +
                    '<span class="message"></span>'
                );

                jQuery('.form-item-captcha-keypad-input .clear').click(function () {
                    jQuery('.captcha-keypad-input').val('');
                    jQuery('.captcha-keypad-wrapper .message').html('');
                });

                jQuery('.captcha-keypad .inner span').click(function () {
                    var value = jQuery('.captcha-keypad-input').val()
                    jQuery('.captcha-keypad-input').val(value + jQuery(this).text());
                    jQuery('.captcha-keypad-wrapper .message').html('');
                });
            })
        }
    };
})(jQuery);
