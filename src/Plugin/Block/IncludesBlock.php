<?php

/**
 * @file
 * Contains \Drupal\ucb_js_includes\Plugin\Block\CampusNewsBlock.
 */

namespace Drupal\ucb_js_includes\Plugin\Block;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Config\ImmutableConfig;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a Block.
 *
 * @Block(
 *   id = "includes_block",
 *   admin_label = @Translation("Includes Block"),
 *   category = @Translation("External JavaScript"),
 * )
 */
class IncludesBlock extends BlockBase implements ContainerFactoryPluginInterface{
	/**
	 * @var \Drupal\Core\Config\ImmutableConfig $moduleConfiguration
	 *   Contains the configuration parameters for this module.
	 */
  public $moduleConfiguration;
  
  	/**
	 * Constructs a JSIncludesBlock.
	 * @param array $configuration
	 * @param string $plugin_id
	 * @param mixed $plugin_definition
	 * @param \Drupal\Core\Config\ImmutableConfig $moduleConfiguration
	 */
	public function __construct(array $configuration, $plugin_id, $plugin_definition, ImmutableConfig $moduleConfiguration) {
		parent::__construct($configuration, $plugin_id, $plugin_definition);
		$this->moduleConfiguration = $moduleConfiguration;
	}

  	/**
	 * {@inheritdoc}
	 */
	public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
		return new static(
			$configuration,
			$plugin_id,
			$plugin_definition,
			$container->get('config.factory')->get('ucb_js_includes.configuration')
		);
  }

  public function build() {
    $blockConfiguration = $this->getConfiguration();
    // $admitHub = [];
    // // AdmitHub
    // if(isset($blockConfiguration['includes_block_ah_license']) && isset($blockConfiguration['includes_block_ah_college'])){
    //   $admitHub = array(
    //     'ah_license'=> $blockConfiguration['includes_block_ah_license'],
    //     'ah_college'=> $blockConfiguration['includes_block_ah_college']
    //   );
    // };
    // // Live Chat
    // $liveChat = [];
    // if(isset($blockConfiguration['includes_block_lc_license'])){
    //   $liveChat = array(
    //     'ah_license'=> $blockConfiguration['includes_block_lc_license'],
    //   );
    // };

    // // Slate
    // $slate = [];
    // if(isset($blockConfiguration['includes_block_slate_form_id']) && isset($blockConfiguration['includes_block_slate_domain'])){
    //   $slate = array(
    //     'form_id'=> $blockConfiguration['includes_block_slate_form_id'],
    //     'domain'=> $blockConfiguration['includes_block_slate_domain']
    //   );
    // };

    // // Status Page
    // $statusPage = [];
    // if(isset($blockConfiguration['includes_block_sp_url'])){
    //   $slate = array(
    //     'url'=> $blockConfiguration['includes_block_sp_url'],
    //   );
    // };

    return [
			'#data' => [
				'includes_block' => $blockConfiguration['includes_block'], 
        // 'block_type' => $blockConfiguration['block_type']
        // 'config'=> array(
        //   'admitHub' => $admitHub,
        //   'liveChat' => $liveChat,
        //   'slate'=> $slate,
        //   'statusPage' => $statusPage
        // )
			],
			'#theme' => 'ucb_js_includes'
		];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['includes_block'] = [
			'#type'           => 'radios',
			'#title'          => $this->t('Include Block Type'),
			'#options'        => [
				'AdmitHub' =>$this->t('Add AdmitHub Include'),
				'LiveChat' =>$this->t('Add LiveChat Include'),
				'Slate' =>$this->t('Add SlatePage Include'),
				'StatusPage' =>$this->t('Add StatusPage Include')
			],
      '#attributes' => [
        //define static name and id so we can easier select it
        // 'id' => 'include_block_type',
        // 'name' => 'field_include_block_type',
      ],
			'#description'    => t('Create an Include Block for the selected type'),
      '#default_value' => $this->getConfiguration()['block_type'],
      // '#required' => TRUE,
      // '#required_error' => 'Please select an Include type, as well as provide any secondary information needed for your Include',
		];

    $form['includes_block_ah_license'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'License ID',
      '#states' => [
        //show this textfield only if the AdmitHub is selected above
        'visible' => [
          ':input[name="settings[includes_block]"]' => ['value' => 'AdmitHub'],
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
          ':input[name="settings[includes_block]"]' => ['value' => 'AdmitHub'],
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
          ':input[name="settings[includes_block]"]' => ['value' => 'LiveChat'],
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
          ':input[name="settings[includes_block]"]' => ['value' => 'Slate'],
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
          ':input[name="settings[includes_block]"]' => ['value' => 'Slate'],
        ],
      ],
    ];
    $form['includes_block_sp_url'] = [
      '#type' => 'textfield',
      '#size' => '60',
      '#placeholder' => 'StatusPage.io URL',
      '#states' => [
        //show this textfield only if the StatusPage is selected above
        'visible' => [
          ':input[name="settings[includes_block]"]' => ['value' => 'StatusPage'],
        ],
      ],
    ];
    return $form;
  }

  	/**
	 * {@inheritdoc}
	 */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $formvValues = $form_state->getValues();

		$this->configuration['includes_block'] = $formvValues;
    // $this->configuration['block_type'] = $formvValues['values']['includes_block'];

    parent::blockSubmit($form, $form_state);

  }

  public function defaultConfiguration() {
    return [
      'includes_block' => "", 
      // 'block_type'=>""
    ];
  }

}