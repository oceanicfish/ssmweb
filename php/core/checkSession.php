<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/10/2015
 * Time: 2:21 PM
 */
session_start();

if(is_null($_SESSION['jeuser'])) {
    header('Location: '.'http://localhost/console/login.html');
}else {
    $jeusername = $_SESSION['jeuser'];
    $tid = $_SESSION['tid'];
}