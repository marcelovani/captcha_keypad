<?php

namespace Drupal\captcha_keypad\Form;

use Drupal\comment\Entity\CommentType;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;

class CaptchaKeypadSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'captcha_keypad_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['captcha_keypad.settings'];
  }

  /**
   * Configuration form.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form_ids = [];

    $form['captcha_keypad_code_size'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Code size'),
      '#description' => $this->t('Size of the code.'),
      '#size' => 2,
      '#maxlength' => 2,
      '#default_value' => $this->config('captcha_keypad.settings')->get('captcha_keypad_code_size'),
      '#required' => TRUE,
    ];

    $form['captcha_keypad_shuffle_keypad'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Shuffle keypad'),
      '#description' => $this->t('Selecting this option will make the keys appear in random order.'),
      '#default_value' => $this->config('captcha_keypad.settings')->get('captcha_keypad_shuffle_keypad'),
    ];

    // Contact.
    if (\Drupal::moduleHandler()->moduleExists('contact')) {
      $ids = \Drupal::service('entity.query')->get('contact_form')->execute();
      foreach ($ids as $id) {
        $form_ids['contact_message_' . $id . '_form'] = $this->t('Contact: :id', [':id' => $id]);
      }
    }

    // User.
    if (\Drupal::moduleHandler()->moduleExists('user')) {
      $form_ids['user_register_form'] = $this->t('User: register');
      $form_ids['user_pass'] = $this->t('User: Forgot password');
      $form_ids['user_login_form'] = $this->t('User: Login');
      $form_ids['user_login_block'] = $this->t('User: Login block');
    }

    // Comment.
    if (\Drupal::moduleHandler()->moduleExists('comment')) {
      $comment_types = CommentType::loadMultiple();
      foreach ($comment_types as $id => $item) {
        $form_ids['comment_' . $id . '_form'] = $this->t('Comment: :item', [':item' => $item->getDescription()]);
      }
    }

    // Forum.
    if (\Drupal::moduleHandler()->moduleExists('forum')) {
      $form_ids['comment_comment_forum_form'] = $this->t('Forum: comment');
    }

    $form['captcha_keypad_forms'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('Forms'),
      '#options' => $form_ids,
      '#default_value' => $this->config('captcha_keypad.settings')->get('captcha_keypad_forms'),
      '#description' => $this->t('Select which forms to add captcha keypad.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Form validator.
   *
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('captcha_keypad.settings');
    $config->set('captcha_keypad_code_size', $form_state->getValue('captcha_keypad_code_size'));
    $config->set('captcha_keypad_shuffle_keypad', $form_state->getValue('captcha_keypad_shuffle_keypad'));
    $config->set('captcha_keypad_forms', $form_state->getValue('captcha_keypad_forms'));
    $config->save();

    parent::submitForm($form, $form_state);
  }
}
