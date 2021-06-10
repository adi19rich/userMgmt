<?php

namespace Drupal\userMgmt\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;

/**
 * Class DisplayTableController
 * @package Drupal\userMgmt\Controller
 */
class DisplayTableController extends ControllerBase
{

  public function index()
  {
    //create table header
    $header_table = array(
      'id' => t('ID'),
      'first_name' => t('first name'),
      'last_name' => t('last name'),
      'email' => t('Email'),
      'phone' => t('phone'),
	  'select' => t('select'),
      'view' => t('View'),
      'delete' => t('Delete'),
      'edit' => t('Edit'),
    );


    // get data from database
    $query = \Drupal::database()->select('userMgmt', 'm');
    $query->fields('m', ['id', 'first_name', 'last_name', 'email', 'phone', 'select']);
    $results = $query->execute()->fetchAll();
    $rows = array();
    foreach ($results as $data) {
      $url_delete = Url::fromRoute('userMgmt.delete_form', ['id' => $data->id], []);
      $url_edit = Url::fromRoute('userMgmt.add_form', ['id' => $data->id], []);
      $url_view = Url::fromRoute('userMgmt.show_data', ['id' => $data->id], []);
      $linkDelete = Link::fromTextAndUrl('Delete', $url_delete);
      $linkEdit = Link::fromTextAndUrl('Edit', $url_edit);
      $linkView = Link::fromTextAndUrl('View', $url_view);

      //get data
      $rows[] = array(
        'id' => $data->id,
        'first_name' => $data->first_name,
        'last_name' => $data->last_name,
        'email' => $data->email,
        'phone' => $data->phone,
		'select' => $data->select,
        'view' => $linkView,
        'delete' => $linkDelete,
        'edit' =>  $linkEdit,
      );

    }
    // render table
    $form['table'] = [
      '#type' => 'table',
      '#header' => $header_table,
      '#rows' => $rows,
      '#empty' => t('No data found'),
    ];
    return $form;

  }

}