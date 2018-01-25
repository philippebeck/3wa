<?php

// **************** \\
// ***** USER ***** \\
// **************** \\

namespace App\Helper;

use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** ***************\
* Helper User class
*/
class User
{

  /** ************************************************\
  * Checks the connection then returns the owner email
  * @return string => the owner email
  */
  public static function ownerEmail()
  {
    // Checks if a user is connected
    if (Session::isLogged() == false)
    {
      return null;
    }
    // Reads the owner datas, then stores it
    $owner = ModelFactory::get('User')->read(1);

    // Returns the owner email
    return $owner['email'];
  }


  /** ************************************************\
  * Checks the connection then returns the admin email
  * @return string => the user email
  */
  public static function adminEmail()
  {
    // Checks if a user is connected
    if (Session::isLogged() == false)
    {
      return null;
    }
    // Reads the admin datas, then stores it
    $admin = ModelFactory::get('User')->read(2);

    // Returns the admin email
    return $admin['email'];
  }
}
