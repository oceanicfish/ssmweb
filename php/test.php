<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/9/15
 * Time: 5:45 PM
 */
session_start();

var_dump($_SESSION['jeuser']);
if(is_null($_SESSION['jeuser'])) {
    var_dump('Location: '.'http://localhost/console/login.html');
}