<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 3:43 PM
 */
require '../service/SettingService.php';

$service = new SettingService();
$result = $service->getSkype();
echo json_encode($result);