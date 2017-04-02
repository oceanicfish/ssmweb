<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 2:29 PM
 */
require '../core/Database.php';

class TeacherService
{

    /**
     * get all teachers
     * @return array
     */
    public function getTeachers() {

        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.teacher order by name';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * insert new teacher
     * @param $teaher
     * @return bool
     */
    public function newTeacher($teaher) {

        $db = new Database();
        $db->connect();

        $skills = implode(' , ', $teaher->skills);

        $sql = 'insert into jeonline.teacher (name, rate, skype, qq, '.
            'skills, cdate, status) '.
            'values (\''.
            $teaher->name .'\', \''.
            $teaher->rate .'\', \''.
            $teaher->skype .'\', \''.
            $teaher->qq .'\', \''.
            $skills .'\', \''.
            $teaher->cdate .'\', \''.
            $teaher->status .'\')';

        $result = $db->update($sql);

        if(!$result) {
            error_log('insert to teacher failed');
            error_log('-- SQL :'.$sql);
            $db->close();
            return $result;
        }

        $sql = 'select max(id) as mid from jeonline.teacher';

        $result = $db->selectOne($sql);

        $mid = $result['mid'];

        $sql = 'insert into jeonline.jeadmin(username, homepage, password, tid) '.
            'values (\''.
            $teaher->name .'\', \'record_t\', \''.
            $teaher->password .'\', \''.
            $mid .'\')';

        $result = $db->update($sql);

        if(!$result) {
            error_log('insert to jeadmin failed');
            error_log('-- SQL :'.$sql);
        }

        $db->close();
        return $result;
    }
}