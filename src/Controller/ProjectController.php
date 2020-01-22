<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;
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
        if (!empty($this->post->getPostArray())) {

            $data['image'] = $this->files->uploadFile('img/portfolio');

            $data['name']         = $this->post->getPostVar('name');
            $data['link']         = $this->post->getPostVar('link');
            $data['year']         = $this->post->getPostVar('year');
            $data['description']  = $this->post->getPostVar('description');

            ModelFactory::get('Project')->create($data);
            $this->cookie->createAlert('Nouveau projet créé avec succès !');

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
    if (!empty($this->post->getPostArray())) {

      if (!empty($this->files->getFileVar('name'))) {
        $data['image'] = $this->files->uploadFile('img/portfolio');
      }

      $data['name']         = $this->post->getPostVar('name');
      $data['link']         = $this->post->getPostVar('link');
      $data['year']         = $this->post->getPostVar('year');
      $data['description']  = $this->post->getPostVar('description');

      ModelFactory::get('Project')->update($this->get->getGetVar('id'), $data);
      $this->cookie->createAlert('Modification réussie du projet sélectionné !');

      $this->redirect('admin');
    }
    $project = ModelFactory::get('Project')->read($this->get->getGetVar('id'));

    return $this->render('admin/portfolio/updateProject.twig', ['project' => $project]);
  }

    public function deleteMethod()
  {
    ModelFactory::get('Project')->delete($this->get->getGetVar('id'));
    $this->cookie->createAlert('Projet réellement supprimé !');

    $this->redirect('admin');
  }
}
