<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends Controller
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {
        if ($this->session->isLogged()) {

            $allArticles = ModelFactory::get('Article')->list();
            $allComments = ModelFactory::get('Comment')->list();
            $allUsers    = ModelFactory::get('User')   ->list();

            $allProjects = ModelFactory::get('Project')->list();
            $allPens     = ModelFactory::get('Pen')    ->list();
            $allRoutes   = ModelFactory::get('Route')  ->list();
            $allCourses  = ModelFactory::get('Course') ->list();

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
        $this->cookie->createAlert('Vous devez être connecté pour accéder à l\'administration');

        $this->redirect('user!login');
    }
}
