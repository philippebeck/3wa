<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ProjectController
 * @package App\Controller
 */
class ProjectController extends MainController
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

            $data['image'] = $this->globals->getFiles()->uploadFile('img/portfolio');

            $data['name']         = $this->globals->getPost()->getPostVar('name');
            $data['link']         = $this->globals->getPost()->getPostVar('link');
            $data['year']         = $this->globals->getPost()->getPostVar('year');
            $data['description']  = $this->globals->getPost()->getPostVar('description');

            ModelFactory::getModel('Project')->createData($data);
            $this->globals->getSession()->createAlert('Nouveau projet créé avec succès !', 'valid');

            $this->redirect('admin');
        }
        return $this->render('admin/portfolio/createProject.twig');
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

      if (!empty($this->globals->getFiles()->getFileVar('name'))) {
        $data['image'] = $this->globals->getFiles()->uploadFile('img/portfolio');
      }

      $data['name']         = $this->globals->getPost()->getPostVar('name');
      $data['link']         = $this->globals->getPost()->getPostVar('link');
      $data['year']         = $this->globals->getPost()->getPostVar('year');
      $data['description']  = $this->globals->getPost()->getPostVar('description');

      ModelFactory::getModel('Project')->updateData($this->globals->getGet()->getGetVar('id'), $data);
      $this->globals->getSession()->createAlert('Modification réussie du projet sélectionné !', 'info');

      $this->redirect('admin');
    }
    $project = ModelFactory::getModel('Project')->readData($this->globals->getGet()->getGetVar('id'));

    return $this->render('admin/portfolio/updateProject.twig', ['project' => $project]);
  }

    public function deleteMethod()
  {
    ModelFactory::getModel('Project')->deleteData($this->globals->getGet()->getGetVar('id'));
    $this->globals->getSession()->createAlert('Projet réellement supprimé !', 'delete');

    $this->redirect('admin');
  }
}
