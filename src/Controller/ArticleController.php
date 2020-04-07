<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class ArticleController
 * @package App\Controller
 */
class ArticleController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allArticles = ModelFactory::getModel('Article')->listData();

        return $this->render('blog/blog.twig', ['allArticles' => $allArticles]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createMethod()
    {
        if (!empty($this->globals->getPost()->getPostArray())) {

            $data['image'] = $this->globals->getFiles()->uploadFile('img/blog');

            $data['title']        = $this->globals->getPost()->getPostVar('title');
            $data['link']         = $this->globals->getPost()->getPostVar('link');
            $data['content']      = $this->globals->getPost()->getPostVar('content');
            $data['created_date'] = $this->globals->getPost()->getPostVar('date');
            $data['updated_date'] = $this->globals->getPost()->getPostVar('date');

            ModelFactory::getModel('Article')->createData($data);
            $this->globals->getSession()->createAlert('Nouvel article créé avec succès !', 'valid');

            $this->redirect('admin');
        }
        return $this->render('admin/blog/createArticle.twig');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function readMethod()
    {
        $article    = ModelFactory::getModel('Article')->readData($this->globals->getGet()->getGetVar('id'));
        $comments   = ModelFactory::getModel('Comment')->list($this->globals->getGet()->getGetVar('id'), 'article_id');

        if(!empty($comments)) {

            for ($i = 0; $i < count($comments); $i++) {

                $userId = $comments[$i]['user_id'];
                $user   = ModelFactory::getModel('User')->readData($userId);

                $comments[$i]['user']   = $user['first_name'];
                $comments[$i]['image']  = $user['image'];
            }
        } else {
            $this->globals->getSession()->createAlert('Soyez le premier à commenter cet article !', 'valid');
        }

        return $this->render('blog/readArticle.twig', [
            'article'   => $article,
            'comments'  => $comments
        ]);
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
                $data['image'] = $this->globals->getFiles()->uploadFile('img/blog');
            }

            $data['title']        = $this->globals->getPost()->getPostVar('title');
            $data['link']         = $this->globals->getPost()->getPostVar('link');
            $data['content']      = $this->globals->getPost()->getPostVar('content');
            $data['updated_date'] = $this->globals->getPost()->getPostVar('date');

            ModelFactory::getModel('Article')->updateData($this->globals->getGet()->getGetVar('id'), $data);
            $this->globals->getSession()->createAlert('Modification réussie de l\'article sélectionné !', 'info');

            $this->redirect('admin');
        }
        $article = ModelFactory::getModel('Article')->readData($this->globals->getGet()->getGetVar('id'));

        return $this->render('admin/blog/updateArticle.twig', ['article' => $article]);
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('Article')->deleteData($this->globals->getGet()->getGetVar('id'));
        $this->globals->getSession()->createAlert('Article définitivement supprimé !', 'delete');

        $this->redirect('admin');
    }
}
