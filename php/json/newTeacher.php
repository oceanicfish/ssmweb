<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 2:44 PM
 */
require '../service/TeacherService.php';

$post = file_get_contents("php://input");
$teacher = json_decode($post);

$response = array();

$service = new TeacherService();
if($service->newTeacher($teacher)) {
    $response['success'] = true;
}else {
    $response['success'] = false;
    $response['message'] = 'Sorry, there are something wrong with database';
}

echo json_encode($response);