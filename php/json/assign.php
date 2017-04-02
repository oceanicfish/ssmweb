<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 2:32 PM
 */
require '../service/AssignmentService.php';

$student = $_REQUEST['student'];
$teacherName = $_REQUEST['teacher'];
$tid = $_REQUEST['tid'];

$response = array();

$service = new AssignmentService();
if($service->assign($student, $teacherName, $tid)) {
    $response['success'] = true;
}else {
    $response['success'] = false;
    $response['message'] = 'Sorry, there are something wrong with database';
}

echo json_encode($response);