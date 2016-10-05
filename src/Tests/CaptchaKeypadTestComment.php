<?php

namespace Drupal\captcha_keypad\Tests;

use Drupal\simpletest\WebTestBase;
/**
 * Tests Captcha Keypad on comment forms.
 *
 * @group captcha_keypad
 */
class CaptchaKeypadTestComment extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('comment', 'captcha_keypad');

  /**
   * A user with the 'Administer Captcha keypad' permission.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  protected function setUp() {
    parent::setUp();

    // Create admin user.
    $this->adminUser = $this->drupalCreateUser(array('administer captcha keypad'), 'Captcha Keypad Admin', TRUE);
  }

  /**
   * Test for Contact forms.
   */
  function testCaptchaKeypadCommentForm() {
    $this->drupalLogin($this->adminUser);

    // Create article node type.
    $this->drupalCreateContentType(array(
      'type' => 'article',
      'name' => 'Article',
    ));

    $this->drupalGet('admin/config/system/captcha_keypad');
    //$edit['captcha_keypad_forms[comment_comment_form]'] = 1; @todo need to enable comment on content type first.

    $element = $this->xpath('//input[@type="checkbox" and @name="captcha_keypad_forms[comment_comment_forum_form]" and @checked="checked"]');
    $this->assertTrue(count($element) === 1, 'Forum form is checked.');

    $this->assertRaw('Need to implement');
  }
}
