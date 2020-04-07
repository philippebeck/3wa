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
        if (!empty($this->globals->getPost()->getPostArray())) {

            ModelFactory::getModel('Pen')->createData($this->globals->getPost()->getPostArray());
            $this->globals->getSession()->createAlert('Nouveau pen créé avec succès !', 'valid');

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
        if (!empty($this->globals->getPost()->getPostArray())) {

            ModelFactory::getModel('Pen')->updateData($this->globals->getGet()->getGetVar('id'), $this->globals->getPost()->getPostArray());
            $this->globals->getSession()->createAlert('Modification réussie du pen sélectionné !', 'info');

            $this->redirect('admin');
        }
        $pen = ModelFactory::getModel('Pen')->readData($this->globals->getGet()->getGetVar('id'));

        return $this->render('admin/portfolio/updatePen.twig', ['pen' => $pen]);
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('Pen')->deleteData($this->globals->getGet()->getGetVar('id'));
        $this->globals->getSession()->createAlert('Pen réellement supprimé !', 'delete');

        $this->redirect('admin');
    }
}
