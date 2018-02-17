<?php

// **************************** \\
// ***** OWNER CONTROLLER ***** \\
// **************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;

use App\Helper\User;


/** ***********************************\
* All control actions to the owner page
*/
class OwnerController extends Controller
{

  /** ******************\
  * Render the main view
  * @return mixed => the rendering of the view owner
  */
  public function IndexAction()
  {
    // Checks if the user is connected
    if (Session::islogged())
    {
      // Checks if the user is the owner or the administrator
      if (Session::userEmail() == User::ownerEmail() || Session::userEmail() == User::adminEmail())
      {
        // Creates a special message to welcome the 3W Academy jury
        htmlspecialchars(Session::createAlert('Cette section cachée vous est réservée afin de vous y présenter l\'ensemble des projets...', 'special'));

        // Returns the rendering of the view owner
        return $this->render('owner/owner.twig');
      }
      else {
        // Creates a warning message to inform that only the owner & the admin can access to this page
        htmlspecialchars(Session::createAlert('Accès réservé au propriétaire et à l\'administrateur du site', 'warning'));

        // Redirects to the view home
        $this->redirect('home');
      }
    }
    else {
      // Creates a cancel message to ask to be connected
      htmlspecialchars(Session::createAlert('Vous devez être connecté pour accéder à la section cachée', 'cancel'));

      // Redirects to the view loginUser
      $this->redirect('user!login');
    }
  }
}
