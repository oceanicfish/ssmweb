<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/7/15
 * Time: 4:02 PM
 */
require '../service/StudentService.php';

$waiting = $_REQUEST['waiting'];
$service = new StudentService();
$result;
if($waiting) {
    $result = $service->waitingStudents();
}else {
    $result = $service->allStudents();
}

echo json_encode($result);
