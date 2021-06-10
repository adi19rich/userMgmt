<?php

namespace Drupal\userMgmt\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\file\Entity\File;
use Symfony\Component\HttpFoundation\RedirectResponse;


class userMgmtForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'userMgmt_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
	$conn = Database::getConnection();
	$data = array();
    if (isset($_GET['id'])) {
      $query = $conn->select('userMgmt', 'm')
        ->condition('id', $_GET['id'])
        ->fields('m');
      $data = $query->execute()->fetchAssoc();
    }
	
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('first name'),
      '#required' => true,
      '#size' => 60,
      '#default_value' => (isset($data['first_name'])) ? $data['first_name'] : '',
      '#maxlength' => 128,
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12']
    ];
    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('last name'),
      '#required' => true,
      '#size' => 60,
      '#default_value' => (isset($data['last_name'])) ? $data['last_name'] : '',
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12']
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('email'),
      '#required' => true,
      '#default_value' => (isset($data['email'])) ? $data['email'] : '',
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12']
    ];
    $form['phone'] = [
      '#type' => 'tel',
      '#title' => $this->t('phone'),
      '#required' => true,
      '#default_value' => (isset($data['phone'])) ? $data['phone'] : '',
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12']
    ];
    $form['select'] = [
      '#type' => 'select',
      '#title' => $this
        ->t('Status'),
      '#options' => [
        'Active' => $this
          ->t('Active'),
        'InActive' => $this
          ->t('InActive'),
      ],
      '#wrapper_attributes' => ['class' => 'col-md-6 col-xs-12'],
      '#default_value' => (isset($data['select'])) ? $data['select'] : '',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('save'),
      '#buttom_type' => 'primary'
    ];
    return $form;
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if (is_numeric($form_state->getValue('first_name'))) {
      $form_state->setErrorByName('first_name', $this->t('Error, The First Name Must Be A String'));
    }
  }


  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $data = array(
      'first_name' => $form_state->getValue('first_name'),
      'last_name' => $form_state->getValue('last_name'),
      'email' => $form_state->getValue('email'),
      'phone' => $form_state->getValue('phone'),
      'select' => $form_state->getValue('select'),
    );


    if (isset($_GET['id'])) {
      // update data in database
      \Drupal::database()->update('userMgmt')->fields($data)->condition('id', $_GET['id'])->execute();
    } else {
      // insert data to database
      \Drupal::database()->insert('userMgmt')->fields($data)->execute();
    }

    // show message and redirect to list page
    \Drupal::messenger()->addStatus('Succesfully saved');
    $url = new Url('userMgmt.display_data');
    $response = new RedirectResponse($url->toString());
    $response->send();
  }


}