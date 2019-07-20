<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends Controller
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function loginAction()
    {
        if (!empty($this->post->getPostArray())) {

            $user = ModelFactory::get('User')->read($this->post->getPostVar('email'), 'email');

            if (password_verify($this->post->getPostVar('pass'), $user['pass'])) {

                $this->session->createSession(
                    $user['id'],
                    $user['name'],
                    $user['image'],
                    $user['email']
                );

                $this->cookie->createAlert('Authentification réussie, bienvenue ' . $user['name'] .' !');

                $this->redirect('home');
            }
            $this->cookie->createAlert('Authentification échouée !');
        }
        return $this->render('user/loginUser.twig');
    }

    public function logoutAction()
    {
        $this->session->destroySession();

        $this->redirect('home');
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function createAction()
    {
        if (!empty($this->post->getPostArray())) {
            $user = ModelFactory::get('User')->read($this->post->getPostVar('email'), 'email');

            if (empty($user) == false) {
                $this->cookie->createAlert('Il existe déjà un compte utilisateur avec cette adresse e-mail');
            }

            $data['image']  = $this->files->uploadFile('img/user');
            $data['pass']   = password_hash($this->post->getPostVar('pass'), PASSWORD_DEFAULT);
            $data['name']   = $this->post->getPostVar('name');
            $data['email']  = $this->post->getPostVar('email');

            ModelFactory::get('User')->create($data);
            $this->cookie->createAlert('Nouvel utilisateur créé avec succès !');

            $this->redirect('home');
        }
        return $this->render('user/createUser.twig');
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

            if (!empty($this->files->getFileVar('name'))) {
                $data['image'] = $this->files->uploadFile('img/user');
            }

            $data['pass']   = password_hash($_POST['pass'], PASSWORD_DEFAULT);
            $data['name']   = $this->post->getPostVar('name');
            $data['email']  = $this->post->getPostVar('email');

            ModelFactory::get('User')->update($this->get->getGetVar('id'), $data);
            $this->cookie->createAlert('Modification réussie de l\'utilisateur sélectionné !');

            $this->redirect('home');
        }
        $user = ModelFactory::get('User')->read($this->get->getGetVar('id'));

        return $this->render('user/updateUser.twig', ['user' => $user]);
    }

    public function deleteAction()
    {
        ModelFactory::get('User')->delete($this->get->getGetVar('id'));
        $this->cookie->createAlert('Utilisateur définitivement supprimé !');

        $this->redirect('home');
    }
}
