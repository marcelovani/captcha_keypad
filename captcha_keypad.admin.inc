<?php

/**
 * @file captcha_keypad.admin.inc
 * Admin settings.
 */

/**
 * Form builder.
 */
function captcha_keypad_settings_form($form, &$form_state) {
  $form['captcha_keypad_code_size'] = array(
    '#type' => 'textfield',
    '#title' => t('Code size'),
    '#description' => t('Size of the code.'),
    '#size' => 2,
    '#maxlength' => 2,
    '#default_value' => variable_get('captcha_keypad_code_size', 4),
    '#required' => TRUE,
  );

  return system_settings_form($form);
}

/**
 * Form validate handler.
 */
function captcha_keypad_settings_form_validate($form, &$form_state) {
/*  if ($form_state['values']['element'] != 'hello') {
    form_set_error('element', t('Please say hello?'));
  }*/
}

/**
 * Form submit handler.
 */
function captcha_keypad_settings_form_submit($form, &$form_state) {

}
