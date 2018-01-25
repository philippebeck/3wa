<?php

// **************************** \\
// ***** ADMIN CONTROLLER ***** \\
// **************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;

use App\Helper\User;


/** ***************************************\
* All control actions to the administration
*/
class AdminController extends Controller
{

  /** *********************************************************************\
  * Reads all objects for CRUD actions from the database, then display them
  * @return mixed => the rendering of the view admin
  */
  public function IndexAction()
  {
    // Checks if the user is connected
    if (Session::islogged())
    {
      // Checks if the user is the owner or the administrator
      if (Session::userEmail() == User::ownerEmail() || Session::userEmail() == User::adminEmail())
      {
        // Reads all articles, users & comments from the Blog, then stores them
        $allArticles = ModelFactory::get('Article')->list();
        $allComments = ModelFactory::get('Comment')->list();
        $allUsers    = ModelFactory::get('User')   ->list();

        // Reads all projects, pens, routes & courses from the Portfolio, then stores them
        $allProjects = ModelFactory::get('Project')->list();
        $allPens     = ModelFactory::get('Pen')    ->list();
        $allRoutes   = ModelFactory::get('Route')  ->list();
        $allCourses  = ModelFactory::get('Course') ->list();

        // Returns the rendering of the view admin with the blog datas & the portfolio datas
        return $this->render('admin/admin.twig', [
          'allArticles'       => $allArticles,
          'allComments'       => $allComments,
          'allUsers'          => $allUsers,
          'allProjects'       => $allProjects,
          'allPens'           => $allPens,
          'allRoutes'         => $allRoutes,
          'allCourses'        => $allCourses
        ]);
      }
      else {
        // Creates a warning message to inform that only the owner & the admin can access to this page
        Session::createAlert('Accès réservé au propriétaire et à l\'administrateur du site', 'warning');

        // Redirects to the view home
        $this->redirect('home');
      }
    }
    else {
      // Creates a cancel message to ask to be connected
      Session::createAlert('Vous devez être connecté pour accéder à l\'administration', 'cancel');

      // Redirects to the view loginUser
      $this->redirect('user!login');
    }
  }
}
