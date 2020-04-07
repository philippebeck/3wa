<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class RouteController
 * @package App\Controller
 */
class RouteController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if (!empty($this->globals->getPost()->getPostArray())) {

            ModelFactory::getModel('Route')->createData($this->globals->getPost()->getPostArray());
            $this->globals->getSession()->createAlert('Nouveau parcours créé avec succès !', 'valid');

            $this->redirect('admin');
        }
        return $this->render('admin/portfolio/createRoute.twig');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function updateMethod()
    {
        if (!empty($this->globals->getPost()->getPostArray())) {

            ModelFactory::getModel('Route')->updateData($this->globals->getGet()->getGetVar('id'), $this->globals->getPost()->getPostArray());
            $this->globals->getSession()->createAlert('Modification réussie du parcours sélectionné !', 'info');

            $this->redirect('admin');
        }
        $route = ModelFactory::getModel('Route')->readData($this->globals->getGet()->getGetVar('id'));

        return $this->render('admin/portfolio/updateRoute.twig', ['route' => $route]);
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('Route')->deleteData($this->globals->getGet()->getGetVar('id'));
        $this->globals->getSession()->createAlert('Parcours définitivement supprimé !', 'delete');

        $this->redirect('admin');
    }
}
