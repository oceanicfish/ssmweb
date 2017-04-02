<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 5:07 PM
 */
require "../service/RecordService.php";

$post = file_get_contents("php://input");
$record = json_decode($post);

$response = array();

$service = new RecordService();
if($service->newRecord($record)) {
    $response['success'] = true;
}else {
    $response['success'] = false;
    $response['message'] = 'Sorry, This student has no more classes left';
}

echo json_encode($response);