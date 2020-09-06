<?php
/**
 * Created by PhpStorm.
 * User: elvis
 * Date: 02.10.2018
 * Time: 18:01
 */

namespace myshop;


final class Registry
{
    use TSingleton;
    protected static $properties = [];
    /**
     * @return array
     */
    public function getProperty($name)
    {
        if(isset(self::$properties[$name]))
            return self::$properties[$name];
        return null;
    }
    /**
     * @param array $prorerties
     */
    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }

    public function getProperties(){
        return self::$properties;
    }

}