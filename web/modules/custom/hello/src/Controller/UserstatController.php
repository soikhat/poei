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

    foreach ($query as $stats){

      $result [] = [$stats->action == '1'? $this->t('login'):$this->t('logout'),
        \Drupal::service('date.formatter')->format($stats->time)] ;
    }

    $stat =[
      '#theme'=>'table',
      '#header' =>['action','time'],
      '#rows' => $result,

    ];

    $message = t('You are on the statistics Page');
    return ['#markup' =>$message,

      $stat,

    ];


  }

}