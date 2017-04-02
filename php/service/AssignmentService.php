<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 2:33 PM
 */
require "../core/Database.php";

class AssignmentService
{

    public function assign($student, $teacherName, $tid) {

        $db = new Database();
        $db->connect();

        $sql = 'update jeonline.student set teacher=\''.$teacherName.'\', '.
            'tid=\''.$tid.'\''.
            ' where wechat=\''.$student.'\'';

        $result = $db->update($sql);

        if(!$result) {
            error_log('update to student failed');
            error_log('-- SQL :'.$sql);
            $db->close();
            return $result;
        }

        $sql = 'update jeonline.teacher set status=\'teaching\''.
            ' where id=\''.$tid.'\'';

        $result = $db->update($sql);

        if(!$result) {
            error_log('update to student failed');
            error_log('-- SQL :'.$sql);
        }

        $db->close();
        return $result;
    }
}