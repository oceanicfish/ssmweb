<?php

/**
 * Created by PhpStorm.
 * User: yangwei
 * Date: 10/7/15
 * Time: 5:38 PM
 */
require '../core/Database.php';

class IncomeService
{
    /**
     * get all incomes
     * @return array
     */
    public function getIncomes() {

        $db = new Database();
        $db->connect();

        $sql = 'select * from jeonline.payment order by pdate desc';

        $result = $db->select($sql);

        return $result;
    }

    /**
     * insert new income
     * @param $income
     * @return bool
     */
    public function newIncome($income) {
        $db = new Database();
        $db->connect();

        $sql = 'insert into jeonline.payment (wechat, name, hours, rate, '.
                                                'amount, pdate, agent, '.
                                                'description, expired) '.
                                                'values (\''.
                                                $income->wechat .'\', \''.
                                                $income->name .'\', \''.
                                                $income->hours .'\', \''.
                                                $income->rate .'\', \''.
                                                $income->amount .'\', \''.
                                                $income->pdate .'\', \''.
                                                $income->agent .'\', \''.
                                                $income->description .'\', \''.
                                                $income->expired .'\')';
        $result = $db->update($sql);

        if(!$result) {
            error_log('insert to income failed');
            error_log('-- SQL :'.$sql);
            $db->close();
            return $result;
        }

        $sql = 'update jeonline.student set hours = hours + '.$income->hours.
                ' where wechat=\''.$income->wechat.'\'';
        $result = $db->update($sql);

        if(!$result) {
            error_log('update to student failed');
            error_log('-- SQL :'.$sql);
        }

        $db->close();
        return $result;
    }
}