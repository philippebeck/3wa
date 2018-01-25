<?php

/* *********************************** */
/* ***** TEST PAM TWIG EXTENSION ***** */
/* *********************************** */

namespace Tests\Twig;

use PHPUnit\Pam\TestCase;
use Pam\View\Pam_Twig_Extension;

/**
 * Tests the Twig extension methods
 */
class Test_Pam_Twig_Extension extends TestCase
{
  /**
   * Tests the method whose returns the url of a page
   * @param   string  $page   => the name of the page
   * @param   array   $params => the url parameters
   * @return  string          => the url of the page
   */
  public function testUrl()
  {
    // Creates & stores the Twig extension
    $pam_twig = new Pam_Twig_Extension();

    // Calls the 'url' method & stores the result
    $url = $pam_twig->url('admin', ['id' => '2']);

    // Try to match the result with the string url
    $this->assertEquals('index.php?id=2&p=admin', $url);
  }
}
