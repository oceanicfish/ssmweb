<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 4:46 PM
 */
require "../core/Database.php";

class RecordService
{

    /**
     * fetch all records
     * @return array
     */
    public function allRecords() {
        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.record order by cdate desc';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * fetch records related particular teacher
     * @return array
     */
    public function myRecords($tid) {
        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.record where tid = \''.$tid.'\' order by cdate desc';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * insert a new record
     * @param $record
     * @return bool
     */
    public function newRecord($record) {
        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.student where wechat=\''.$record->sid.'\'';

        $result = $db->selectOne($sql);

        $hours = $result['hours'];

        if($hours > 0) {

            $sql = 'insert into jeonline.record (teacher, tid, student, sid, '.
                'cdate, cfrom, clength, note) '.
                'values (\''.
                $record->teacher .'\', \''.
                $record->tid .'\', \''.
                $record->student .'\', \''.
                $record->sid .'\', \''.
                strtotime($record->cdate) .'\', \''.
                $record->cfrom .'\', \''.
                $record->clength .'\', \''.
                $record->note .'\')';
            $result = $db->update($sql);

            if(!$result) {
                error_log('insert to record failed');
                error_log('-- SQL :'.$sql);
                $db->close();
                return $result;
            }

            $sql = 'update jeonline.student set hours = hours - '.$record->clength.
                ' where wechat=\''.$record->sid.'\'';
            $result = $db->update($sql);

            if(!$result) {
                error_log('update to student failed');
                error_log('-- SQL :'.$sql);
            }

            $db->close();
            return $result;
        }

        return false;
    }
}