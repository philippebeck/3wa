<?php

// ***************************** \\
// ***** COURSE CONTROLLER ***** \\
// ***************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** ********************************\
* All control actions to the courses
*/
class CourseController extends Controller
{

  /** ******************\
  * Creates a new course
  * @return mixed => the rendering of the view createCourse
  */
  public function CreateAction()
  {
    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Creates the course
      ModelFactory::get('Course')->create($_POST);

      // Creates a valid message to confirm the creation of a new course
      Session::createAlert('Nouveau cours créé avec succès !', 'valid');

      // Redirects to the view admin
      $this->redirect('admin');
    }
    else {
      // Returns the rendering of the view createCourse with the empty fields
      return $this->render('admin/portfolio/createCourse.twig');
    }
  }


  /** **************\
  * Updates a course
  * @return mixed => the rendering of the view updateCourse
  */
  public function UpdateAction()
  {
    // Gets the course id, then stores it
    $id = $_GET['id'];

    // Checks if the form has been completed
    if (!empty($_POST))
    {
      // Updates the selected course
      ModelFactory::get('Course')->update($id, $_POST);

      // Creates an info message to confirm the update of the selected course
      Session::createAlert('Modification réussie du cours sélectionné !', 'info');

      // Redirects to the view admin
      $this->redirect('admin');
    }
    // Reads the selected course, then stores it
    $course = ModelFactory::get('Course')->read($id);

    // Returns the rendering of the view updateCourse with the course
    return $this->render('admin/portfolio/updateCourse.twig', ['course' => $course]);
  }


  /** **************\
  * Deletes a course
  */
  public function DeleteAction()
  {
    // Gets the course id, then stores it
    $id = $_GET['id'];

    // Deletes the selected course
    ModelFactory::get('Course')->delete($id);

    // Creates a delete message to confirm the removal of the selected course
    Session::createAlert('Cours définitivement supprimé !', 'delete');

    // Redirects to the view admin
    $this->redirect('admin');
  }
}
