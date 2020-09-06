<?php


namespace myshop\base;


abstract class Controller
{
    public $route; //Массив с текущем путем хъ
    public $controller;
    public $model;
    public $view;
    public $layout;
    public $prefix;
    public $data = [];
    public $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

    public function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function setMeta($title = '', $desc = '', $keywords = ''): void
    {
        $this->meta['title'] = $title;
        $this->meta['$desc'] = $desc;
        $this->meta['$keywords'] = $keywords;
    }

    public function set($data)
    {
        $this->data = $data;
    }

    public function getView()
    {
        $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObject->render($this->data);
    }
}