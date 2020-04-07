<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class CourseController
 * @package App\Controller
 */
class CourseController extends MainController
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

            ModelFactory::getModel('Course')->createData($this->globals->getPost()->getPostArray());
            $this->globals->getSession()->createAlert('Nouveau cours créé avec succès !', 'valid');

            $this->redirect('admin');
        }
        return $this->render('admin/portfolio/createCourse.twig');
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

            ModelFactory::getModel('Course')->updateData($this->globals->getGet()->getGetVar('id'), $this->globals->getPost()->getPostArray());
            $this->globals->getSession()->createAlert('Modification réussie du cours sélectionné !', 'info');

            $this->redirect('admin');
        }
        $course = ModelFactory::getModel('Course')->readData($this->globals->getGet()->getGetVar('id'));

        return $this->render('admin/portfolio/updateCourse.twig', ['course' => $course]);
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('Course')->deleteData($this->globals->getGet()->getGetVar('id'));
        $this->globals->getSession()->createAlert('Cours définitivement supprimé !', 'delete');

        $this->redirect('admin');
    }
}
