<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 3:38 PM
 */
require '../core/Database.php';

class SettingService
{

    /**
     * get newest skype id
     * @return array
     */
    public function getSkype() {
        $db = new Database();
        $db->connect();

        $sql = 'select skype from jeonline.skype order by id desc';

        $result = $db->selectOne($sql);

        return $result;
    }

    /**
     * get newest skype id
     * @return array
     */
    public function getQQ() {
        $db = new Database();
        $db->connect();

        $sql = 'select qq from jeonline.qq order by id desc';

        $result = $db->selectOne($sql);

        return $result;
    }
}