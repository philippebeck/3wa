<?php

// **************************** \\
// ***** PHOTO CONTROLLER ***** \\
// **************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Model\ModelFactory;
use Pam\Helper\Session;


/** *******************************\
* All control actions to the photos
*/
class PhotoController extends Controller
{

  /** **************\
  * Reads all photos
  * @return mixed => the rendering of the view photos
  */
  public function IndexAction()
  {
    // Reads all photos, then stores them
    $allPhotos = ModelFactory::get('Photo')->list();

    // Returns the rendering of the view photo with all photos
    return $this->render('photo/photos.twig', [
      'allPhotos' => $allPhotos
    ]);
  }


  /** *******************************************\
  * Reads a photo, his object & his constellation
  * @return mixed => the rendering of the view readPhoto
  */
  public function ReadAction()
  {
    // Gets the photo id, then stores it
    $id = $_GET['id'];

    // Reads the photo, his object & his constellation, then stores them
    $photo      = ModelFactory::get('Photo')        ->read($id);
    $photoObj   = ModelFactory::get('Object')       ->read($photo['object_id']);
    $photoConst = ModelFactory::get('Constellation')->read($photo['const_id']);

    // Returns the rendering of the view readPhoto with the current photo, his object & his constellation
    return $this->render('photo/readPhoto.twig', [
      'photo'      => $photo,
      'photoObj'   => $photoObj,
      'photoConst' => $photoConst
    ]);
  }
}
