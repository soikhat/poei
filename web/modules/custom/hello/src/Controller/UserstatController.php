<?php

namespace Drupal\hello\Controller ;

use Drupal\Core\Controller\ControllerBase ;
use Drupal\user\UserInterface;


class UserstatController extends ControllerBase {

  public function content(UserInterface $user){


    $query = \Drupal::database()->select('hello_user_statistics','us')
                                ->fields('us',['action','time'])
                                ->execute();

    $result =[];
    $count = 0;

    foreach ($query as $stats){

      $result [] = [$stats->action == '1'? $this->t('login'):$this->t('logout'),
        \Drupal::service('date.formatter')->format($stats->time)] ;

      $count += $stats->action;
    }


    $stat =[
      '#theme'=>'table',
      '#header' =>['action','time'],
      '#rows' => $result,

    ];


    $message = [
      '#theme'=>'hello',
      '#user' =>$user,
      '#count' => $count ,
    ];

    //$message = t('You are on the statistics Page');
    return [

      'message' =>$message,
      'stats'=>$stat,

    ];


  }

}