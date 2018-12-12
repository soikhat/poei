<?php

namespace Drupal\hello\Controller ;

use Drupal\Core\Controller\ControllerBase ;


class ListeNoeudsController extends ControllerBase {

  public function content($noeuds = NULL){

    $storage = \Drupal::entityTypeManager()->getStorage('node');
    $query = $storage->getQuery();
    if($noeuds){
      $query ->condition('type',$noeuds);
    }
    //la fonction pager permet d'avoir une pagination
    $ids = $query->pager('10')->execute();

    $entities = $storage->loadMultiple($ids);


    $items=[];
    foreach ($entities as $entity){

      $items[] = $entity ->toLink();
    }

    $list = [
      '#theme'=>'item_list',
      '#items' => $items,
      '#title' => $this->t('Node Liste')
    ];
    $pager =['#type'=>'pager'];

    return [
      'list'=>$list,
      'pager'=>$pager,
      '#cache'=>[
        'keys'=>['hello:node_list'],
        'tags'=>['node_list'],
        'contexts'=>['url'],
        ],

    ];

  }

}
