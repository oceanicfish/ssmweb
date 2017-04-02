<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 4:45 PM
 */
require "../service/RecordService.php";

$tid = $_REQUEST['tid'];
$service = new RecordService();

if(empty($tid)) {
    $result = $service->allRecords();
}else {
    $result = $service->myRecords($tid);
}

echo json_encode($result);