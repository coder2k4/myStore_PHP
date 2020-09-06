<?php


namespace myshop;


class Db
{
    use TSingleton;

    protected function __construct()
    {
        $db = require_once CONF.'/config_db.php';
        class_alias('\RedBeanPHP\R','\R');
        \R::setup($db['dns'],$db['user'],$db['password']);
        if(!\R::testConnection()){
            throw new \Exception('Нет соединения с базой данных', 500);
        }
        else
        {
            echo 'Connection with DB successful';
        }
        \R::freeze( TRUE );
        if(DEBUG)
            \R::debug (TRUE,1);
    }


}