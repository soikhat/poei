<?php
namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {

  public function getFormId(){
    return 'config-form';
  }
  protected function getEditableConfigNames(){
    return ['hello.settings'];
  }
  public function buildForm(array $form, FormStateInterface $form_state){

    $form= [];
    $form['items']= array(
      '#type'=>'select',
      '#title' =>$this->t('Config choices'),
      '#options'=> [
        '0'=>'0 day',
        '1'=>'1 day',
        '2'=>'2 days',
        '3'=>'7 days',
        '4'=>'14 days',
        '5'=>'30 days',

      ]
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this
        ->t('Save the hello configurations'),
    );

    return parent::buildForm($form,$form_state);


  }
  public function submitForm(array &$form, FormStateInterface $form_state){

    $value =$this->config('hello.settings')->set('purge_days_number',$form_state->getValue('items'))->save();
    parent::submitForm($form, $form_state);
  }

}