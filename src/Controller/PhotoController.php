<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class PhotoController
 * @package App\Controller
 */
class PhotoController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allPhotos = ModelFactory::get('Photo')->list();

        return $this->render('photo/photos.twig', [
            'allPhotos' => $allPhotos
        ]);
    }

    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function readMethod()
    {
        $photo      = ModelFactory::get('Photo')->read($this->get->getGetVar('id'));
        $photoObj   = ModelFactory::get('Object')->read($photo['object_id']);
        $photoConst = ModelFactory::get('Constellation')->read($photo['const_id']);

        return $this->render('photo/readPhoto.twig', [
            'photo'      => $photo,
            'photoObj'   => $photoObj,
            'photoConst' => $photoConst
        ]);
    }
}
