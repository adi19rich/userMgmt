<?php

namespace Drupal\userMgmt\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\file\Entity\File;

/**
 * Class MydataController
 * @package Drupal\userMgmt\Controller
 */
class userMgmtController extends ControllerBase
{

  /**
   * @return array
   */
  public function show($id)
  {

    $conn = Database::getConnection();

    $query = $conn->select('userMgmt', 'm')
      ->condition('id', $id)
      ->fields('m');
    $data = $query->execute()->fetchAssoc();
    $full_name = $data['first_name'] . ' ' . $data['last_name'];
    $email = $data['email'];
    $phone = $data['phone'];
    $select = $data['select'];


    return [
      '#type' => 'markup',
      '#markup' => "<h1>$full_name</h1><br>
                    <p>$email</p>
                    <p>$phone</p>
                    <p>$select</p>"
    ];
  }

}