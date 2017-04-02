<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/7/15
 * Time: 4:02 PM
 */
require '../service/StudentService.php';

$tid = $_REQUEST['tid'];
$service = new StudentService();

if(empty($tid)) {
    $result = $service->allStudents();
}else {
    $result = $service->myStudents($tid);
}

echo json_encode($result);
