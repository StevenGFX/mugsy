<?php

namespace Drupal\mugsy\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

/**
 * Class ApiKeyController.
 */
class ApiKeyController extends ControllerBase {

  /**
   * Drupal\Core\Config\ConfigFactoryInterface definition.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * Constructs a new ApiKeyController object.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * ShowKey.
   *
   * @return string
   *   Return Hello string.
   */
  public function showKey() {

    // Get the configuration object.
    $config = $this->configFactory->get('mugsy.config');
    // Get the value of the key 'mugsy_shared_api_key'.
    $key = $config->get('mugsy_shared_api_key');

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Your Mugsy Shared API Key is: @key', ['@key' => $key])
    ];
  }

}
