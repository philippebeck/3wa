<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PjsController
 * @package App\Controller
 */
class PjsController extends Controller
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
  {
    return $this->render('pjs/pjs.twig');
  }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function pamAction()
  {
    return $this->render('pjs/pam.twig');
  }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function jimAction()
  {
    return $this->render('pjs/jim.twig');
  }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function samAction()
  {
    return $this->render('pjs/sam.twig');
  }
}
