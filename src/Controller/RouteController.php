<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class RouteController
 * @package App\Controller
 */
class RouteController extends Controller
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createAction()
    {
        if (!empty($this->post->getPostArray())) {

            ModelFactory::get('Route')->create($this->post->getPostArray());
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
    public function updateAction()
    {
        if (!empty($this->post->getPostArray())) {

            ModelFactory::get('Route')->update($this->get->getGetVar('id'), $this->post->getPostArray());
            $this->cookie->createAlert('Modification réussie du parcours sélectionné !');

            $this->redirect('admin');
        }
        $route = ModelFactory::get('Route')->read($this->get->getGetVar('id'));

        return $this->render('admin/portfolio/updateRoute.twig', ['route' => $route]);
    }

    public function deleteAction()
    {
        ModelFactory::get('Route')->delete($this->get->getGetVar('id'));
        $this->cookie->createAlert('Parcours définitivement supprimé !');

        $this->redirect('admin');
    }
}
