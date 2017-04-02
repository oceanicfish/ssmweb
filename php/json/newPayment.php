<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 10:54 AM
 */
require '../service/IncomeService.php';

$post = file_get_contents("php://input");
$income = json_decode($post);

$response = array();

$service = new IncomeService();
if($service->newIncome($income)) {
    $response['success'] = true;
}else {
    $response['success'] = false;
    $response['message'] = 'Sorry, there are something wrong with database';
}

echo json_encode($response);
