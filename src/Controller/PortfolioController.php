<?php

// ******************************** \\
// ***** PORTFOLIO CONTROLLER ***** \\
// ******************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** **********************************\
* All control actions to the portfolio
*/
class PortfolioController extends Controller
{

  /** ***********************\
  * Render the portfolio view
  * @return mixed => the rendering of the view portfolio
  */
  public function IndexAction()
  {
    // Reads all projects, pens, routes & courses from the Portfolio, then stores them
    $allProjects = ModelFactory::get('Project')->list();
    $allPens     = ModelFactory::get('Pen')    ->list();
    $allRoutes   = ModelFactory::get('Route')  ->list();
    $allCourses  = ModelFactory::get('Course') ->list();

    // Returns the rendering of the view portfolio
    return $this->render('portfolio/portfolio.twig', [
      'allProjects' => $allProjects,
      'allPens'     => $allPens,
      'allRoutes'   => $allRoutes,
      'allCourses'  => $allCourses
    ]);
  }
}
