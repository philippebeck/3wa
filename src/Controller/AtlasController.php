<?php

namespace App\Controller;

use Pam\Controller\MainController;
use Pam\Model\Factory\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AtlasController
 * @package App\Controller
 */
class AtlasController extends MainController
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function defaultMethod()
    {
        $allAtlas = ModelFactory::getModel('Atlas')->listData();

        return $this->render('atlas/atlas.twig', [
            'allAtlas' => $allAtlas
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
        $atlas      = ModelFactory::getModel('Atlas')->readData($this->get->getGetVar('id'));
        $atlasMaps  = ModelFactory::getModel('Map')->list($this->get->getGetVar('id'), 'atlas_id', 1);

        return $this->render('atlas/readAtlas.twig', [
            'atlas'     => $atlas,
            'atlasMaps' => $atlasMaps
        ]);
    }
}
