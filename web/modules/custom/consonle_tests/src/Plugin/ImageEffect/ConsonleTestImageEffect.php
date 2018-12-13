<?php

namespace Drupal\consonle_tests\Plugin\ImageEffect;

use Drupal\Core\Image\ImageInterface;
use Drupal\image\ImageEffectBase;

/**
 * Provides a 'ConsonleTestImageEffect' image effect.
 *
 * @ImageEffect(
 *  id = "consonle_test_image_effect",
 *  label = @Translation("Consonle test image effect"),
 *  description = @Translation("Console tests blur.")
 * )
 */
class ConsonleTestImageEffect extends ImageEffectBase {

  /**
   * {@inheritdoc}
   */
  public function applyEffect(ImageInterface $image) {
    // Implement Image Effect.
    return imagefilter($image->getToolkit()->getResource(),IMG_FILTER_NEGATE,NULL);
  }

}
