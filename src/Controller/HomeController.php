<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function IndexAction()
  {
    $allArticles  = ModelFactory::get('Article')->list();
    $allProjects  = ModelFactory::get('Project')->list();
    $allPhotos    = ModelFactory::get('Photo')  ->list();
    $allMaps      = ModelFactory::get('Map')    ->list();

    unset($allProjects[0]);

    $article  = $allArticles[array_rand($allArticles)];
    $project  = $allProjects[array_rand($allProjects)];
    $photo    = $allPhotos[array_rand($allPhotos)];
    $map      = $allMaps[array_rand($allMaps)];

    return $this->render('home.twig', [
      'article' => $article,
      'project' => $project,
      'photo'   => $photo,
      'map'     => $map
    ]);
  }
}
