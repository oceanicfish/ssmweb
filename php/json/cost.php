<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 4:35 PM
 */
require '../service/CostService.php';

$service = new CostService();
$result = $service->getCosts();
echo json_encode($result);