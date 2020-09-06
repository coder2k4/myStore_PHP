<?php
/**
 * Created by PhpStorm.
 * User: elvis
 * Date: 02.10.2018
 * Time: 18:03
 * Реализация Singleton + Trait
 */

namespace myshop;


trait TSingleton
{

    private static $instance;

    public static function instance (){
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }

}