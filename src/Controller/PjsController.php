<?php

// ************************** \\
// ***** PJS CONTROLLER ***** \\
// ************************** \\

namespace App\Controller;

use Pam\Controller\Controller;
use Pam\Helper\Session;


/** ************************\
* All control actions to Pjs
*/
class PjsController extends Controller
{

  /** ******************\
  * Render the Pjs view
  * @return mixed => the rendering of the view pjs
  */
  public function IndexAction()
  {
    // Returns the rendering of the view pjs
    return $this->render('pjs/pjs.twig');
  }


  /** ******************\
  * Render the Pam view
  * @return mixed => the rendering of the view pam
  */
  public function PamAction()
  {
    // Returns the rendering of the view pam
    return $this->render('pjs/pam.twig');
  }


  /** ******************\
  * Render the Jim view
  * @return mixed => the rendering of the view jim
  */
  public function JimAction()
  {
    // Returns the rendering of the view jim
    return $this->render('pjs/jim.twig');
  }


  /** ******************\
  * Render the Sam view
  * @return mixed => the rendering of the view sam
  */
  public function SamAction()
  {
    // Returns the rendering of the view sam
    return $this->render('pjs/sam.twig');
  }
}
