<?php

// **************************** \\
// ***** ATLAS CONTROLLER ***** \\
// **************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** ******************************\
* All control actions to the atlas
*/
class AtlasController extends Controller
{

  /** *************\
  * Reads all atlas
  * @return mixed => the rendering of the view atlas
  */
  public function IndexAction()
  {
    // Reads all atlas & maps, then stores them
    $allAtlas = ModelFactory::get('Atlas')->list();

    // Returns the rendering of the view atlas with all atlas
    return $this->render('atlas/atlas.twig', [
      'allAtlas' => $allAtlas
    ]);
  }


  /** ***********************\
  * Reads an atlas & his maps
  * @return mixed => the rendering of the view readAtlas
  */
  public function ReadAction()
  {
    // Gets the atlas id, then stores it
    $id = $_GET['id'];

    // Reads the atlas & his maps, then stores them
    $atlas      = ModelFactory::get('Atlas')->read($id);
    $atlasMaps  = ModelFactory::get('Map')  ->list($id, 'atlas_id', 1);

    // Returns the rendering of the view readAtlas with the current atlas & his maps
    return $this->render('atlas/readAtlas.twig', [
      'atlas'     => $atlas,
      'atlasMaps' => $atlasMaps
    ]);
  }
}
