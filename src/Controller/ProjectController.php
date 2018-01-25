<?php

// ****************************** \\
// ***** PROJECT CONTROLLER ***** \\
// ****************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** *********************************\
* All control actions to the projects
*/
class ProjectController extends Controller
{

  /** *******************\
  * Creates a new project
  * @return mixed => the rendering of the view createProject
  */
  public function CreateAction()
  {
    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Uploads the image, then stores it
      $data['image'] = $this->upload('img/portfolio');

      // Retrieves form data, then stores them
      $data['name']         = $_POST['name'];
      $data['link']         = $_POST['link'];
      $data['year']         = $_POST['year'];
      $data['description']  = $_POST['description'];

      // Creates a new project
      ModelFactory::get('Project')->create($data);

      // Creates a valid message to confirm the creation of a new project
      Session::createAlert('Nouveau projet créé avec succès !', 'valid');

      // Redirects to the view admin
      $this->redirect('admin');
    }
    else {
      // Returns the rendering of the view createProject with the empty fields
      return $this->render('admin/portfolio/createProject.twig');
    }
  }


  /** ***************\
  * Updates a project
  * @return mixed => the rendering of the view updateProject
  */
  public function UpdateAction()
  {
    // Gets the project id, then stores it
    $id = $_GET['id'];

    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Checks if a new file has been uploaded
      if (!empty($_FILES['file']['name']))
      {
        // Uploads the image, then stores it
        $data['image'] = $this->upload('img/portfolio');
      }

      // Retrieves form data, then stores them
      $data['name']         = $_POST['name'];
      $data['link']         = $_POST['link'];
      $data['year']         = $_POST['year'];
      $data['description']  = $_POST['description'];

      // Updates the selected article
      ModelFactory::get('Project')->update($id, $data);

      // Creates an info message to confirm the update of the selected project
      Session::createAlert('Modification réussie du projet sélectionné !', 'info');

      // Redirects to the view admin
      $this->redirect('admin');
    }
    // Reads the selected project, then stores it
    $project = ModelFactory::get('Project')->read($id);

    // Returns the rendering of the view updateArticle with the article
    return $this->render('admin/portfolio/updateProject.twig', ['project' => $project]);
  }


  /** ***************\
  * Deletes a project
  */
  public function DeleteAction()
  {
    // Gets the article id, then stores it
    $id = $_GET['id'];

    // Deletes the selected article
    ModelFactory::get('Project')->delete($id);

    // Creates a delete message to confirm the removal of the selected project
    Session::createAlert('Projet réellement supprimé !', 'delete');

    // Redirects to the view admin
    $this->redirect('admin');
  }
}
