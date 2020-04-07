<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class UserController
 * @package App\Controller
 */
class UserController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        if (!empty($this->globals->getPost()->getPostArray())) {

            $user = ModelFactory::getModel('User')->readData($this->globals->getPost()->getPostVar('email'), 'email');

            if (password_verify($this->globals->getPost()->getPostVar('pass'), $user['pass'])) {

                $this->globals->getSession()->createSession(
                    $user['id'],
                    $user['name'],
                    $user['image'],
                    $user['email']
                );

                $this->globals->getSession()->createAlert('Authentification réussie, bienvenue ' . $user['name'] .' !', 'info');

                $this->redirect('home');
            }
            $this->globals->getSession()->createAlert('Authentification échouée !', 'warning');
        }
        return $this->render('user/loginUser.twig');
    }

    public function logoutMethod()
    {
        $this->globals->getSession()->destroySession();

        $this->redirect('home');
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
            $user = ModelFactory::getModel('User')->readData($this->globals->getPost()->getPostVar('email'), 'email');

            if (empty($user) == true) {
                $data['image']  = $this->globals->getFiles()->uploadFile('img/user');
                $data['pass']   = password_hash($this->globals->getPost()->getPostVar('pass'), PASSWORD_DEFAULT);
                $data['name']   = $this->globals->getPost()->getPostVar('name');
                $data['email']  = $this->globals->getPost()->getPostVar('email');

                ModelFactory::getModel('User')->createData($data);
                $this->globals->getSession()->createAlert('Nouvel utilisateur créé avec succès !', 'valid');

                $this->redirect('home');
            }
            $this->globals->getSession()->createAlert('Il existe déjà un compte utilisateur avec cette adresse e-mail', 'warning');
        }
        return $this->render('user/createUser.twig');
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
                $data['image'] = $this->globals->getFiles()->uploadFile('img/user');
            }

            $data['pass']   = password_hash($this->globals->getPost()->getPostVar('pass'), PASSWORD_DEFAULT);
            $data['name']   = $this->globals->getPost()->getPostVar('name');
            $data['email']  = $this->globals->getPost()->getPostVar('email');

            ModelFactory::getModel('User')->updateData($this->globals->getGet()->getGetVar('id'), $data);
            $this->globals->getSession()->createAlert('Modification réussie de l\'utilisateur sélectionné !', 'info');

            $this->redirect('home');
        }
        $user = ModelFactory::getModel('User')->readData($this->globals->getGet()->getGetVar('id'));

        return $this->render('user/updateUser.twig', ['user' => $user]);
    }

    public function deleteMethod()
    {
        ModelFactory::getModel('User')->deleteData($this->globals->getGet()->getGetVar('id'));
        $this->globals->getSession()->createAlert('Utilisateur définitivement supprimé !', 'delete');

        $this->redirect('home');
    }
}
