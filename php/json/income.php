<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/7/15
 * Time: 9:03 PM
 */
require '../service/IncomeService.php';

$service = new IncomeService();
$result = $service->getIncomes();
echo json_encode($result);