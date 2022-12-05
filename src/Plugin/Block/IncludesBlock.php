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
			'#type'           => 'radios',
			'#title'          => $this->t('Include Block Type'),
			'#options'        => [
				'Add AdmitHub Include' =>$this->t('AdmitHub'),
				'Add LiveChat Include' =>$this->t('LiveChat'),
				'Add Slate Page Include' =>$this->t('Slate'),
				'Add StatusPage Include' =>$this->t('StatusPage')
			],
      '#attributes' => [
        //define static name and id so we can easier select it
        // 'id' => 'include_block_type',
        'name' => 'field_include_block_type',
      ],
			'#description'    => t('Create an Include Block for the selected type')
		];

    $form['includes_block_ah_license'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'License ID',
      '#states' => [
        //show this textfield only if the AdmitHub is selected above
        'visible' => [
          ':input[name="field_include_block_type"]' => ['value' => 'Add AdmitHub Include'],
        ],
      ],
    ];
    $form['includes_block_ah_college'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'College ID',
      '#states' => [
        //show this textfield only if the AdmitHub is selected above
        'visible' => [
          ':input[name="field_include_block_type"]' => ['value' => 'Add AdmitHub Include'],
        ],
      ],
    ];
    $form['includes_block_lc_license'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'License ID',
      '#states' => [
        //show this textfield only if the LiveChat is selected above
        'visible' => [
          ':input[name="field_include_block_type"]' => ['value' => 'Add LiveChat Include'],
        ],
      ],
    ];
    $form['includes_block_slate_form_id'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'Slate Form ID',
      '#states' => [
        //show this textfield only if the Slate is selected above
        'visible' => [
          ':input[name="field_include_block_type"]' => ['value' => 'Add Slate Page Include'],
        ],
      ],
    ];
    $form['includes_block_slate_domain'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'Slate Domain',
      '#states' => [
        //show this textfield only if the Slate is selected above
        'visible' => [
          ':input[name="field_include_block_type"]' => ['value' => 'Add Slate Page Include'],
        ],
      ],
    ];
    $form['includes_block_sp_url'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'StatusPage.io URL',
      '#states' => [
        //show this textfield only if the AdmitHub is selected above
        'visible' => [
          ':input[name="field_include_block_type"]' => ['value' => 'Add StatusPage Include'],
        ],
      ],
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