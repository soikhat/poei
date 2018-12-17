<?php
namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;

class HelloForm extends FormBase{

  public function getFormId(){

    return 'Calculatrice';
  }

  public function buildForm(array $form, FormStateInterface $form_state){
    if(isset($form_state->getRebuildInfo()['result'])){

      $result = $form_state->getRebuildInfo()['result'];
      $form['result']= array(
        '#markup'=>$this ->t('Result %result',['%result'=>$result])
      );
    }

    $form['first_value'] = array(

      '#type'=>'textfield',
      '#title'=>$this->t('First value'),
      '#description'=>$this ->t('Enter the first value'),
      '#required'=>'TRUE',
      '#ajax'=> array(
        'callback'=>array($this,'validateTextAjax'),
        'event'=>'change',
      ),
      '#suffix'=>'<span class="text-message"></span>',
    );
    $form['operation'] = array(
      '#type' => 'radios',
      '#title' => $this ->t('Operations'),
      '#default_value'=> '+',
      '#options'=> array(

        '+' => $this->t('Add'),
        '-'=> $this -> t('Soustract'),
        '/'=> $this -> t('Divide'),
        '*'=> $this -> t('Multiply'),

      ),

    );
    $form['second_value'] = array(

      '#type'=>'textfield',
      '#title'=>$this->t('Second value'),
      '#description'=>$this ->t('Enter the second value'),
      '#required'=>'TRUE',
    );


    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this
        ->t('calculate'),
    );

    return $form;
  }
  public function validateTextAjax(array &$form, FormStateInterface $form_state){
    $first_value = $form_state-> getValue('first_value');
    if(!is_numeric($first_value)){
      $css =['border'=>'2px solid red'];
      $message ='Oups!!your value is not numeric: '. $form_state->getValue('first_value');
    }
    else{
      $css =['border'=>'2px solid green'];
      $message ='Ok: '. $form_state->getValue('first_value');
    }


    $response = new AjaxResponse();
    $response->addCommand(new CssCommand('#edit-first-value',$css));
    $response->addCommand(new HtmlCommand('.text-message',$message));

    return $response;


  }
  public function validateForm(array &$form,FormStateInterface $form_state ){

    $first_value = $form_state-> getValue('first_value');
    $second_value = $form_state ->getValue('second_value');
    if(!is_numeric($first_value)){
      $form_state ->setErrorByName('first_value',$this->t('first value must be a numeric'));

    }
    if(!is_numeric($second_value)){
      $form_state -> setErrorByName('$second_value', $this->t('second value must be a numeric
        '));
    }
    if($second_value==0 && ($form_state->getValue('operation'))=='/'){
      $form_state -> setErrorByName('$second_value', $this->t('second value must be different of zero'));
    }
    if(isset($form['result'])){
      unset(
        $form['result']
      );
    }

  }

  public function submitForm(array &$form, FormStateInterface $form_state){
    $result =0;
    $first_value = $form_state-> getValue('first_value');
    $second_value = $form_state ->getValue('second_value');
    $operation = $form_state->getValue('operation');
    switch($operation){

      case '+':
        $result = $first_value + $second_value;

        break;
      case '-':
        $result = $first_value-$second_value;
        break;
      case '/':
        $result = $first_value + $second_value;

        break;
      case '*':
        $result = $first_value-$second_value;
        break;
    }

    $form_state -> setRebuild();
    $form_state->addRebuildInfo('result',$result);



  }

}
