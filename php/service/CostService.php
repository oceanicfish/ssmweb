<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/8/15
 * Time: 4:30 PM
 */
require '../core/Database.php';

class CostService
{
    /**
     * get all cost entries
     * @return array
     */
    public function getCosts() {

        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.cost order by cdate desc';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * insert a new cost entry
     * @return bool
     */
    public function newCost($cost) {

        $db = new Database();
        $db->connect();

        $sql = 'insert into jeonline.cost (name, cdate, type, description, amount) '.
            'values (\''.
            $cost->name .'\', \''.
            $cost->cdate .'\', \''.
            $cost->type .'\', \''.
            $cost->description .'\', \''.
            $cost->amount .'\')';
        $result = $db->update($sql);

        if(!$result) {
            error_log('insert to cost failed');
            error_log('-- SQL :'.$sql);
        }

        $db->close();
        return $result;
    }
}