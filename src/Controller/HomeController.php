<?php

// *************************** \\
// ***** HOME CONTROLLER ***** \\
// *************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** *****************************\
* All control actions to the home
*/
class HomeController extends Controller
{

  /** ******************\
  * Render the main view
  * @return mixed => the rendering of the view home
  */
  public function IndexAction()
  {
    // Reads all articles, projects, photos & maps, then stores them
    $allArticles  = ModelFactory::get('Article')->list();
    $allProjects  = ModelFactory::get('Project')->list();
    $allPhotos    = ModelFactory::get('Photo')  ->list();
    $allMaps      = ModelFactory::get('Map')    ->list();

    // Removes the project Pjs for not having a duplicate item on the home page
    unset($allProjects[0]);

    // Randomly selects one object in each global object model
    $article  = $allArticles[array_rand($allArticles)];
    $project  = $allProjects[array_rand($allProjects)];
    $photo    = $allPhotos[array_rand($allPhotos)];
    $map      = $allMaps[array_rand($allMaps)];

    // Returns the rendering of the view home with one random article, one random project, one random photo & one random map
    return $this->render('home.twig', [
      'article' => $article,
      'project' => $project,
      'photo'   => $photo,
      'map'     => $map
    ]);
  }
}
