<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 10:54 AM
 */
require '../service/CostService.php';

$post = file_get_contents("php://input");
$cost = json_decode($post);

$response = array();

$service = new CostService();
if($service->newCost($cost)) {
    $response['success'] = true;
}else {
    $response['success'] = false;
    $response['message'] = 'Sorry, there are something wrong with database';
}

echo json_encode($response);
