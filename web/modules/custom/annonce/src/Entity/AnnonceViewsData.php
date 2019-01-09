<?php

namespace Drupal\annonce\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Annonce entities.
 */
class AnnonceViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */

  public function getViewsData() {

    $data = parent::getViewsData();
    $data['annonce_views_statistics']['table']['group']= t('annonce history');
    $data['annonce_views_statistics']['table']['provider']= 'annonce';
    $data['annonce_views_statistics']['table']['base'] = array(
      'field' => 'id',
      'title'=>t('annonce history Id'),
      'weight'=> -100,
    );
    $data['annonce_views_statistics']['uid']= array (
      'title'=>t('user id'),
      'help'=> t('User annonce Id'),
      'field'=>['id'=>'numeric'],
      'relationship'=>array(
        'base'=>'users_field_data',
        'base field'=>'uid',
        'id'=>'standard',
        'label' => t('annonce user id'),
      ),
    );
    $data['annonce_views_statistics']['aid']= array(
      'title'=>t('annonce Id'),
      'field'=>['id'=>'numeric'],
      'relationship'=>[
        'base'=>'annonce_field_data',
        'base field' => 'id',
        'id'=>'standard',
        'label'=> t('Annonce id'),
      ],
    );
    $data['annonce_views_statistics']['time']=[
      'title'=> t('Annonce date view'),
      'field'=>['id'=>'date'],

    ];



    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
