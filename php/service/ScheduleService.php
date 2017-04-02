<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 12:03 PM
 */
require '../core/Database.php';

class ScheduleService
{
    public function getSchedules($wechat) {

        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.schedule where pid = \''.$wechat.'\' order by id';

        $result = $db->select($sql);

        return $result;
    }
}