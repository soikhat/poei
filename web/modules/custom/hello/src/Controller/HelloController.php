<?php

namespace Drupal\hello\Controller ;

use Drupal\Core\Controller\ControllerBase ;
use Symfony\Component\HttpFoundation\JsonResponse;

class HelloController extends ControllerBase {

  public function content($param =''){
    $message = t('You are on the Hello Page and your user name is %username %param!',
      ['%username'=> $this->currentUser()->getAccountName(),'%param'=>$param ]);
    return ['#markup' =>$message];
    //

  }
  public function json(){

    $response = new JsonResponse();
    $response ->setData(['1'=>'toto','2'=>'tata','3'=>'titi']);

    return $response;
  }
}
