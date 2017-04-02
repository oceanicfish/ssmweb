<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/7/15
 * Time: 11:48 AM
 */

require '../core/Database.php';
require '../model/Student.php';
require '../model/Schedule.php';

class StudentService
{

    /**
     * get all students
     * @return array
     */
    public function allStudents() {
        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.student order by name';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * get all students related to particular teacher
     * @return array
     */
    public function myStudents($tid) {
        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.student where tid = \''.$tid.'\' and hours > 0 order by name';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * get all waiting students
     * @return array
     */
    public function waitingStudents() {
        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.student where hours > 0 order by name';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * get the students with wechat ID
     * @param $wechat
     * @return array
     */
    public function getStudent($wechat) {
        $db = new Database();
        $db->connect();

        $sql = 'select wechat, name from jeonline.student where wechat = \''.$wechat.'\'';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * insert new student record with schedule
     * @param $student
     * @return bool
     */
    public function create($student) {

        $db = new Database();
        $db->connect();

        $requirement = implode(' , ', $student->requirement);

        $sql = 'insert into jeonline.student(name, gender, age, job, listening, '.
                                    'reading, speaking, writing, cdate, '.
                                    'toeic, esl, wechat, skype, qq, mobile, '.
                                    'requirement, background, target, note) '.
                                    'values (\''.
                                    $student->name .'\', \''.
                                    $student->gender .'\', \''.
                                    $student->age .'\', \''.
                                    $student->job .'\', \''.
                                    $student->listening .'\', \''.
                                    $student->reading .'\', \''.
                                    $student->speaking .'\', \''.
                                    $student->writing .'\', \''.
                                    time() .'\', \''.
                                    $student->toeic .'\', \''.
                                    $student->esl .'\', \''.
                                    $student->wechat .'\', \''.
                                    $student->skype .'\', \''.
                                    $student->qq .'\', \''.
                                    $student->mobile .'\', \''.
                                    $requirement .'\', \''.
                                    $student->background .'\', \''.
                                    $student->target .'\', \''.
                                    $student->note .'\')';

        $result = $db->update($sql);

        if(!$result) {
            error_log('insert to student failed');
            error_log($sql);
            $db->close();
            return $result;
        }

        $sql = '';

        if((!empty($student->monday->time)) && ($student->monday->length > 0)) {
            $sql .= 'insert into jeonline.schedule(pid, cday, cfrom, clength) '.
                'values (\''.
                $student->wechat .'\', \'monday\', \''.
                $student->monday->time .'\', \''.
                $student->monday->length .'\');';
        }

        if((!empty($student->tuesday->time)) && ($student->tuesday->length > 0)) {
            $sql .= 'insert into jeonline.schedule(pid, cday, cfrom, clength) '.
                'values (\''.
                $student->wechat .'\', \'tuesday\', \''.
                $student->tuesday->time .'\', \''.
                $student->tuesday->length .'\');';
        }

        if((!empty($student->wednesday->time)) && ($student->wednesday->length > 0)) {
            $sql .= 'insert into jeonline.schedule(pid, cday, cfrom, clength) '.
                'values (\''.
                $student->wechat .'\', \'wednesday\', \''.
                $student->wednesday->time .'\', \''.
                $student->wednesday->length .'\');';
        }

        if((!empty($student->thursday->time)) && ($student->thursday->length > 0)) {
            $sql .= 'insert into jeonline.schedule(pid, cday, cfrom, clength) '.
                'values (\''.
                $student->wechat .'\', \'thursday\', \''.
                $student->thursday->time .'\', \''.
                $student->thursday->length .'\');';
        }

        if((!empty($student->friday->time)) && ($student->friday->length > 0)) {
            $sql .= 'insert into jeonline.schedule(pid, cday, cfrom, clength) '.
                'values (\''.
                $student->wechat .'\', \'friday\', \''.
                $student->friday->time .'\', \''.
                $student->friday->length .'\');';
        }

        if((!empty($student->saturday->time)) && ($student->saturday->length > 0)) {
            $sql .= 'insert into jeonline.schedule(pid, cday, cfrom, clength) '.
                'values (\''.
                $student->wechat .'\', \'saturday\', \''.
                $student->saturday->time .'\', \''.
                $student->saturday->length .'\');';
        }

        if((!empty($student->sunday->time)) && ($student->sunday->length > 0)) {
            $sql .= 'insert into jeonline.schedule(pid, cday, cfrom, clength) '.
                'values (\''.
                $student->wechat .'\', \'sunday\', \''.
                $student->sunday->time .'\', \''.
                $student->sunday->length .'\');';
        }

//        error_log('SQL Query : ' . $sql);
        $result = $db->multiUpdate($sql);

        if(!$result) {
            error_log('insert into schedule failed');
        }

        $db->close();
        return $result;
    }
}