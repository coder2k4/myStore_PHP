<?php
/**
 * Created by PhpStorm.
 * User: elvis
 * Date: 02.10.2018
 * Time: 17:47
 */

namespace myshop;


/**
 * Class App
 * @package myshop
 */
class App
{
    public static $app;

    public function __construct()
    {
        $query = trim($_SERVER['QUERY_STRING'],'/');
        session_start();
        self::$app = Registry::instance();
        $this->getParams();
        new ErrorHandler();
        Router::dispatch($query);
    }

    protected function getParams(){
        $params = require_once CONF.'/params.php';
        if(!empty($params)){
            foreach ($params as $k=>$v)
            {
                self::$app->setProperty($k, $v);
            }
        }
    }
}