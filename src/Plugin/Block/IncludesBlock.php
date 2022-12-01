<?php

namespace Drupal\IncludesBlock\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block.
 *
 * @Block(
 *   id = "IncludesBlock",
 *   admin_label = @Translation("Includes Block"),
 *   category = @Translation("External JavaScript"),
 * )
 */
class IncludesBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      // This can be a simple bit of markup or a complex render array!
      '#type' => 'html_tag',
      '#tag' => 'div',
      '#attributes' => [
        'class' => [
          'my-class',
        ],
      ],
      // Attach our third party JS, as defined in the module's libraries.yml file.
    //   '#attached' => ['library' => ['library_name/component']],
    ];
  }

}