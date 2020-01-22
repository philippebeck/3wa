<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PortfolioController
 * @package App\Controller
 */
class PortfolioController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
  {
    $allProjects = ModelFactory::getModel('Project')->listData();
    $allPens     = ModelFactory::getModel('Pen')    ->listData();
    $allRoutes   = ModelFactory::getModel('Route')  ->listData();
    $allCourses  = ModelFactory::getModel('Course') ->listData();

    return $this->render('portfolio/portfolio.twig', [
      'allProjects' => $allProjects,
      'allPens'     => $allPens,
      'allRoutes'   => $allRoutes,
      'allCourses'  => $allCourses
    ]);
  }
}
