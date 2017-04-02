<?php
/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/3/15
 * Time: 10:51 PM
 */
require '../core/Database.php';

class ContactService
{
    /**
     * get all contacts
     * @return array
     */
    public function getContacts() {

        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.contact order by name';

        $result = $db->select($sql);

        return $result;
    }
}