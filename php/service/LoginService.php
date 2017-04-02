<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/10/2015
 * Time: 1:25 PM
 */

class LoginService
{

    public function login($username, $password) {
        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.jeadmin where username=\''.$username.'\' and password=\''.$password.'\'';

        $result = $db->selectOne($sql);

        return $result;
    }
}