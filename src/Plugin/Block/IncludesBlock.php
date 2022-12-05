<?php

/**
 * @file
 * Contains \Drupal\ucb_js_includes\Plugin\Block\CampusNewsBlock.
 */

namespace Drupal\ucb_js_includes\Plugin\Block;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a Block.
 *
 * @Block(
 *   id = "includes_block",
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

  public function blockForm($form, FormStateInterface $form_state) {
    $form['includes_block'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Who do you want to say hello to?'),
      '#default_value' => $this->configuration['includes_block'],
    ];

    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->configuration['includes_block'] = $values['includes_block'];
  }

  public function defaultConfiguration() {
    return [
      'IncludesBlock' => $this->t(''),
    ];
  }

}