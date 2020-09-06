<?php
/**
 * Created by PhpStorm.
 * User: elvis
 * Date: 03.10.2018
 * Time: 17:10
 */

namespace myshop\base;

use myshop\Db;

abstract class Model
{
    public $attributes = []; //Массив свойств модели (поля в базах данных)
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        Db::instance();
    }
}