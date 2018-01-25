<?php

// ************************* \\
// ***** PENCONTROLLER ***** \\
// ************************* \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** *****************************\
* All control actions to the pens
*/
class PenController extends Controller
{

  /** ***************\
  * Creates a new pen
  * @return mixed => the rendering of the view createPen
  */
  public function CreateAction()
  {
    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Creates the pen
      ModelFactory::get('Pen')->create($_POST);

      // Creates a valid message to confirm the creation of a new
      Session::createAlert('Nouveau pen créé avec succès !', 'valid');

      // Redirects to the view admin
      $this->redirect('admin');
    }
    else {
      // Returns the rendering of the view createPen with the empty fields
      return $this->render('admin/portfolio/createPen.twig');
    }
  }


  /** ***********\
  * Updates a pen
  * @return mixed => the rendering of the view updatePen
  */
  public function UpdateAction()
  {
    // Gets the pen id, then stores it
    $id = $_GET['id'];

    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Updates the selected pen
      ModelFactory::get('Pen')->update($id, $_POST);

      // Creates an info message to confirm the update of the selected pen
      Session::createAlert('Modification réussie du pen sélectionné !', 'info');

      // Redirects to the view admin
      $this->redirect('admin');
    }
    // Reads the selected pen, then stores it
    $pen = ModelFactory::get('Pen')->read($id);

    // Returns the rendering of the view updatePen with the pen
    return $this->render('admin/portfolio/updatePen.twig', ['pen' => $pen]);
  }


  /** ***********\
  * Deletes a pen
  */
  public function DeleteAction()
  {
    // Gets the pen id, then stores it
    $id = $_GET['id'];

    // Deletes the selected pen
    ModelFactory::get('Pen')->delete($id);

    // Creates a delete message to confirm the removal of the selected pen
    Session::createAlert('Pen réellement supprimé !', 'delete');

    // Redirects to the view admin
    $this->redirect('admin');
  }
}
