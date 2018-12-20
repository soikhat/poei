<?php

  namespace Drupal\hello\Access;


  use Drupal\Core\Access\AccessCheckInterface;
  use Drupal\Core\Access\AccessResult;
  use Drupal\Core\Session\AccountInterface;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Route;

  class HelloAccessCheck implements AccessCheckInterface {

    public function applies(Route $route) {
      // TODO: Implement applies() method.
      return NULL;
    }

    public function access (Route $route, Request $request=NULL,AccountInterface $account){

      $param = $route->getRequirement('_access_hello');

      if ($account->isAnonymous()){
        return AccessResult::forbidden()->cachePerUser();
      }
      $account_time = $account->getAccount()->created;
      $acces = REQUEST_TIME - $account_time;

      return AccessResult::allowedif($acces>$param*3600)->cachePerUser();
    }
  }