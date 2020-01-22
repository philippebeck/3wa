<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\ModelFactory;

/**
 * Class CommentController
 * @package App\Controller
 */
class CommentController extends MainController
{
    public function createAction()
    {
        if ($this->session->islogged()) {

            $data['article_id']   = $this->get->getGetVar('id');
            $data['content']      = $this->post->getPostVar('content');
            $data['created_date'] = $this->post->getPostVar('date');
            $data['user_id']      = $this->session->userId();

            ModelFactory::get('Comment')->create($data);

            $this->cookie->createAlert('Nouveau commentaire créé avec succès !');

            $this->redirect('article!read', ['id' => $this->get->getGetVar('id')]);
        }
        $this->cookie->createAlert('Vous devez être connecté pour ajouter un commentaire...');

        $this->redirect('user!login');
    }

    public function deleteAction()
    {
        ModelFactory::get('Comment')->delete($this->get->getGetVar('id'));
        $this->cookie->createAlert('Commentaire définitivement supprimé !');

        $this->redirect('admin');
    }
}
