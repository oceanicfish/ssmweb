<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 12:03 PM
 */
require '../service/ScheduleService.php';

$wechat = $_REQUEST['student'];

$service = new ScheduleService();
$result = $service->getSchedules($wechat);
echo json_encode($result);