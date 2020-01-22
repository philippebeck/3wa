<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PenController
 * @package App\Controller
 */
class PenController extends MainController
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

            ModelFactory::getModel('Pen')->createData($this->post->getPostArray());
            $this->cookie->createAlert('Nouveau pen créé avec succès !');

            $this->redirect('admin');
        }
        return $this->render('admin/portfolio/createPen.twig');
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

            ModelFactory::getModel('Pen')->updateData($this->get->getGetVar('id'), $this->post->getPostArray());
            $this->cookie->createAlert('Modification réussie du pen sélectionné !');

            $this->redirect('admin');
        }
        $pen = ModelFactory::getModel('Pen')->readData($this->get->getGetVar('id'));

        return $this->render('admin/portfolio/updatePen.twig', ['pen' => $pen]);
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('Pen')->deleteData($this->get->getGetVar('id'));
        $this->cookie->createAlert('Pen réellement supprimé !');

        $this->redirect('admin');
    }
}
