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
        if (!empty($this->post->getPostArray())) {

            ModelFactory::getModel('Route')->createData($this->post->getPostArray());
            $this->cookie->createAlert('Nouveau parcours créé avec succès !');

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
        if (!empty($this->post->getPostArray())) {

            ModelFactory::getModel('Route')->updateData($this->get->getGetVar('id'), $this->post->getPostArray());
            $this->cookie->createAlert('Modification réussie du parcours sélectionné !');

            $this->redirect('admin');
        }
        $route = ModelFactory::getModel('Route')->readData($this->get->getGetVar('id'));

        return $this->render('admin/portfolio/updateRoute.twig', ['route' => $route]);
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('Route')->deleteData($this->get->getGetVar('id'));
        $this->cookie->createAlert('Parcours définitivement supprimé !');

        $this->redirect('admin');
    }
}
