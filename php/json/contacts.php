<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/3/15
 * Time: 10:50 PM
 */
require '../service/ContactService.php';

$service = new ContactService();
$result = $service->getContacts();
echo json_encode($result);