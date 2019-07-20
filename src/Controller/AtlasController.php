<?php

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class AtlasController
 * @package App\Controller
 */
class AtlasController extends Controller
{
    /**
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function indexAction()
    {
        $allAtlas = ModelFactory::get('Atlas')->list();

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
    public function readAction()
    {
        $atlas      = ModelFactory::get('Atlas')->read($this->get->getGetVar('id'));
        $atlasMaps  = ModelFactory::get('Map')->list($this->get->getGetVar('id'), 'atlas_id', 1);

        return $this->render('atlas/readAtlas.twig', [
            'atlas'     => $atlas,
            'atlasMaps' => $atlasMaps
        ]);
    }
}
