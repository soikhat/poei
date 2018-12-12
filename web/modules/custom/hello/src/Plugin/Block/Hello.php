<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * provides
 * @Block(
 *   id= "hello_block",
 *   admin_label= @translation("Hello!")
 * )
 * @package Drupal\hello\Plugin\Block
 */
class Hello extends BlockBase{

  /**
   * @return array|mixed
   */
  public function build(){
    $date = \Drupal::service('datetime.time')->getCurrentTime();
    $dateformat = \Drupal::service('date.formatter')->format($date,'custom','H:i:s');
    $username = \Drupal::service('current_user')->getAccountName();
    $build = [
      '#markup'=> $this->t('welcome here %username ! it is %date',
      ['%username'=> $username,
      '%date'=> $dateformat]),
      '#cache'=> [
        'keys'=>['hello.cache'],
        'contexts'=>['user','timezone'],
        'max-age'=>'1000'
      ] ];

    return $build;
  }
}
