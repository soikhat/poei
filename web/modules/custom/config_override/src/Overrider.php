<?php

namespace Drupal\config_override ;

use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;
use Drupal\Core\Session\AccountProxyInterface;

class Overrider implements ConfigFactoryOverrideInterface {
  protected $current_user;
  /*
   *
   */
  public function __construct(AccountProxyInterface $current_user) {

    $this->current_user = $current_user;
    $anonyme = $current_user->isAnonymous();
    $auth = $current_user -> isAuthenticated();
  }

  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    // TODO: Implement createConfigObject() method.
  }
  public function getCacheableMetadata($name) {
    // TODO: Implement getCacheableMetadata() method.
  }
  public function getCacheSuffix() {
    // TODO: Implement getCacheSuffix() method.
  }
  public function loadOverrides($names) {
    // TODO: Implement loadOverrides() method.

    if(in_array('system.site',$names)){
      if($this->current_user ->isAnonymous())

        {$names['system.site']['name']=t('ANON DEV');}

      if($this->current_user ->isAuthenticated()){

        {$names['system.site']['name']=t('AUTH DEV');}
      }

    }

    return $names;
  }
}