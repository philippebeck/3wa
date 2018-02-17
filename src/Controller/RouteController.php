<?php

// **************************** \\
// ***** ROUTE CONTROLLER ***** \\
// **************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** *******************************\
* All control actions to the routes
*/
class RouteController extends Controller
{

  /** *****************\
  * Creates a new route
  * @return mixed => the rendering of the view createRoute
  */
  public function CreateAction()
  {
    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Creates a new route
      ModelFactory::get('Route')->create($_POST);

      // Creates a valid message to confirm the creation of a new route
      htmlspecialchars(Session::createAlert('Nouveau parcours créé avec succès !', 'valid'));

      // Redirects to the view admin
      $this->redirect('admin');
    }
    else {
      // Returns the rendering of the view createRoute with the empty fields
      return $this->render('admin/portfolio/createRoute.twig');
    }
  }


  /** *************\
  * Updates a route
  * @return mixed => the rendering of the view updateRoute
  */
  public function UpdateAction()
  {
    // Gets the route id, then stores it
    $id = $_GET['id'];

    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Updates the selected route
      ModelFactory::get('Route')->update($id, $_POST);

      // Creates an info message to confirm the update of the selected route
      htmlspecialchars(Session::createAlert('Modification réussie du parcours sélectionné !', 'info'));

      // Redirects to the view admin
      $this->redirect('admin');
    }
    // Reads the selected route, then stores it
    $route = ModelFactory::get('Route')->read($id);

    // Returns the rendering of the view updateRoute with the route
    return $this->render('admin/portfolio/updateRoute.twig', ['route' => $route]);
  }


  /** *************\
  * Deletes a route
  */
  public function DeleteAction()
  {
    // Gets the route id, then stores it
    $id = $_GET['id'];

    // Deletes the selected route
    ModelFactory::get('Route')->delete($id);

    // Creates a delete message to confirm the removal of the selected route
    htmlspecialchars(Session::createAlert('Parcours définitivement supprimé !', 'delete'));

    // Redirects to the view admin
    $this->redirect('admin');
  }
}
