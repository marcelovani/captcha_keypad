<?php

namespace Drupal\captcha_keypad\Tests;

use Drupal\simpletest\WebTestBase;
/**
 * Tests Captcha Keypad on contact pages.
 *
 * @group captcha_keypad
 */
class CaptchaKeypadTestForum extends WebTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  public static $modules = array('forum', 'captcha_keypad');

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
  function testCaptchaKeypadForumForm() {
    $this->drupalLogin($this->adminUser);
    $this->assertRaw('Need to implement');
  }
}
