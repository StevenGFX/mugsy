<?php

namespace Drupal\mugsy\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

// Use Drupal\Core\Config\ConfigFactoryInterface.
/**
 * Class ConfigForm.
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'mugsy.config',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'config_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('mugsy.config');
    $form['mugsy_shared_api_key'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Mugsy Shared API Key'),
      '#description' => $this->t('Enter your Mugsy shared API Key.'),
      '#maxlength' => 36,
      '#size' => 36,
      '#default_value' => $config->get('mugsy_shared_api_key'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('mugsy.config')
      ->set('mugsy_shared_api_key', $form_state->getValue('mugsy_shared_api_key'))
      ->save();
  }

}
