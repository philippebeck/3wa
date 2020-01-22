<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allArticles  = ModelFactory::getModel('Article')->listData();
        $allProjects  = ModelFactory::getModel('Project')->listData();
        $allPhotos    = ModelFactory::getModel('Photo')  ->listData();
        $allMaps      = ModelFactory::getModel('Map')    ->listData();

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
