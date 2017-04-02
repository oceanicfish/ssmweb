<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 2:33 PM
 */
require '../service/TeacherService.php';

$service = new TeacherService();
$result = $service->getTeachers();
echo json_encode($result);