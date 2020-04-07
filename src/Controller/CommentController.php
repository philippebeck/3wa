<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends MainController
{
    public function createMethod()
    {
        if ($this->globals->getSession()->islogged()) {

            $data['article_id']   = $this->globals->getGet()->getGetVar('id');
            $data['content']      = $this->globals->getPost()->getPostVar('content');
            $data['created_date'] = $this->globals->getPost()->getPostVar('date');
            $data['user_id']      = $this->globals->getSession()->getUserVar('id');

            ModelFactory::getModel('Comment')->createData($data);

            $this->globals->getSession()->createAlert('Nouveau commentaire créé avec succès !', 'valid');

            $this->redirect('article!read', ['id' => $this->globals->getGet()->getGetVar('id')]);
        }
        $this->globals->getSession()->createAlert('Vous devez être connecté pour ajouter un commentaire...', 'warning');

        $this->redirect('user!login');
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('Comment')->deleteData($this->globals->getGet()->getGetVar('id'));
        $this->globals->getSession()->createAlert('Commentaire définitivement supprimé !', 'delete');

        $this->redirect('admin');
    }
}
