<?php
/**
 * Created by PhpStorm.
 * User: elvis
 * Date: 02.10.2018
 * Time: 21:14
 */

namespace myshop;


class Router
{
    protected static $routes = [];
    protected static $route = [];

    /**
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * @return array
     */
    public static function getRoute(): array
    {
        return self::$route;
    }

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';

            if (class_exists($controller)) {
                $controllerObject = new $controller(self::$route);
                $action = self::$route['action'] . 'Action';
                if (method_exists($controllerObject, $action)) {
                    $controllerObject->$action();
                    $controllerObject->getView();
                } else
                    throw new \Exception("Метод $action не найден в $controller", 404);
            } else {
                throw new \Exception("Контроллер не найден - $controller", 404);
            }
        } else
            throw new \Exception('Старница не найдена', 404);
    }

    protected static function removeQueryString($url)
    {
        if (!empty($url)) {
            $url = explode('&', $url, 2);
            if(strpos($url[0], '=') === false)
                return rtrim($url[0],'/');
            else
                return '';
        }


    }

    //CamelCase

    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#", $url, $mathes)) {
                foreach ($mathes as $k => $v) {
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) $route['action'] = 'index';
                if (!isset($route['prefix'])) $route['prefix'] = '';
                else $route['prefix'] .= '\\';
                $route['controller'] = self::upperCamelCase($route['controller']);
                $route['action'] = self::lowerCamelCase($route['action']);

                self::$route = $route;
                return true;
            }
        }
        return false;
    }

    //camelCase

    protected static function upperCamelCase($controllerName)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $controllerName)));
    }

    protected static function lowerCamelCase($actionName)
    {
        return lcfirst(self::upperCamelCase($actionName));
    }


}