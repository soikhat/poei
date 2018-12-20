<?php

namespace Drupal\hello\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

class HelloSubscriber extends RouteSubscriberBase{

  function alterRoutes(RouteCollection $collection) {
    // TODO: Implement alterRoutes() method.
    $route =$collection ->get('entity.user.canonical')
      ->setRequirements(['_access_hello'=>'4']);


  }

}
