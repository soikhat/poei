<?php

namespace Drupal\block_date\Plugin\Condition;

use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\Context\ContextDefinition;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
* Provides a 'Start and end date' condition to enable a condition based in module selected status.
*
* @Condition(
*   id = "date_condition",
*   label = @Translation("Start and end date")
*
* )
*
*/
class DateCondition extends ConditionPluginBase {

/**
* {@inheritdoc}
*/
public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition)
{
    return new static(
    $configuration,
    $plugin_id,
    $plugin_definition
    );
}

/**
 * Creates a new DateCondition object.
 *
 * @param array $configuration
 *   The plugin configuration, i.e. an array with configuration values keyed
 *   by configuration option name. The special key 'context' may be used to
 *   initialize the defined contexts by setting it to an array of context
 *   values keyed by context names.
 * @param string $plugin_id
 *   The plugin_id for the plugin instance.
 * @param mixed $plugin_definition
 *   The plugin implementation definition.
 */
 public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
 }

 /**
   * {@inheritdoc}
   */
 public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
     // Sort all modules by their names.
     $form['date_debut']= array(
       '#title'=>$this->t('Start date'),
       '#type'=>'date',
       '#default_value'=>$this->configuration['date_debut'],
     );
     $form['date_fin']= array(
       '#title'=>$this->t('End date'),
       '#type'=>'date',
       '#default_value'=>$this->configuration['date_fin'],
     );

      return $form;
     //return parent::buildConfigurationForm($form, $form_state);
 }

/**
 * {@inheritdoc}
 */
 public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
   $this->configuration['date_debut'] = $form_state->getValue('date_debut');
   $this->configuration['date_fin'] = $form_state->getValue('date_fin');

     parent::submitConfigurationForm($form, $form_state);


 }

/**
 * {@inheritdoc}
 */
 public function defaultConfiguration() {
    return ['date_debut' => '','date_fin'=>''] + parent::defaultConfiguration();
 }

/**
  * Evaluates the condition and returns TRUE or FALSE accordingly.
  *
  * @return bool
  *   TRUE if the condition has been met, FALSE otherwise.
  */
  public function evaluate() {
    $start_date = $this->configuration['date_debut'] ? new DrupalDateTime($this->configuration['date_debut']): NULL;
    $end_date = $this->configuration['date_fin'] ? new DrupalDateTime($this->configuration['date_fin']): NULL;
    $today = new DrupalDateTime('today');

   return(!$start_date || ($start_date <= $today) && !$end_date || ($end_date >= $today) );
  }

/**
 * Provides a human readable summary of the condition's configuration.
 */
 public function summary()
 {

   return t('Date block condition');
 }

}
