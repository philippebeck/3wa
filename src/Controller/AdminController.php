<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if ($this->globals->getSession()->isLogged()) {

            $allArticles = ModelFactory::getModel('Article')->listData();
            $allComments = ModelFactory::getModel('Comment')->listData();
            $allUsers    = ModelFactory::getModel('User')   ->listData();

            $allProjects = ModelFactory::getModel('Project')->listData();
            $allPens     = ModelFactory::getModel('Pen')    ->listData();
            $allRoutes   = ModelFactory::getModel('Route')  ->listData();
            $allCourses  = ModelFactory::getModel('Course') ->listData();

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
        $this->globals->getSession()->createAlert('Vous devez être connecté pour accéder à l\'administration', 'warning');

        $this->redirect('user!login');
    }
}
