<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * provides
 * @Block(
 *   id= "session_block",
 *   admin_label= @translation("Sessions actives")
 * )
 * @package Drupal\hello\Plugin\Block
 */
class SessionBlock extends BlockBase{

  /**
   * @return array|mixed
   */
  public function build(){
    $database = \Drupal::database();
    $sessionBlock = $database ->select('sessions')
                       ->countQuery()
                       ->execute()
                       ->fetchField();

    $build = [

      '#markup'=> $this->t(' you have %sessionBlock actives sessions',
                ['%sessionBlock'=>$sessionBlock]),
      '#cache'=> [
        'keys'=>['hello.session'],
        'max-age'=>'0'
        ]
      ] ;

    return $build;
  }
  protected function blockAccess(AccountInterface $account){

    return AccessResult::allowedIfHasPermission($account,'access_hello');

  }
}
