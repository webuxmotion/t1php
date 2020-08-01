<?php

namespace core\base;

use core\App;

abstract class Controller
{
  public $route;
  public $controller;
  public $model;
  public $view;
  public $layout;
  public $prefix;
  public $data = [];
  public $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

  public function __construct($route) {
    $this->route = $route;
    $this->controller = $route['controller'];
    $this->model = $route['controller'];
    $this->view = $route['action'];
    $this->prefix = $route['prefix'];
  }

  public function getView() {
    $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
    $viewObject->render($this->data);
  }

  public function set($data) {
    $this->data = $data;
  }

  public function setMeta($title = '', $desc = '', $keywords = ''){
    $this->meta['title'] = h($title);
    $this->meta['desc'] = h($desc);
    $this->meta['keywords'] = h($keywords);
  }

  public function isAjax() {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
  }

  public function loadView($view, $vars = []){
    extract($vars);
    require APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";
    die;
  }

  public function block($filePath, $data = null) {
    if (is_array($data)) extract($data);

    $prefix = App::$app->getProperty('prefix');
    $prefix = $prefix ? $prefix . '/' : null;
    $viewFile = APP . "/views/{$prefix}blocks/{$filePath}/index.php";

    if (is_file($viewFile)) {
      ob_start();
      require $viewFile;
      echo ob_get_clean();
    } else {
      throw new \Exception("File does <b>{$viewFile}</b> not exist");
    }
  }

  public function getRequestID($get = true, $id = 'id') {
    if ($get) {
        $data = $_GET;
    } else {
        $data = $_POST;
    }

    $id = !empty($data[$id]) ? (int)$data[$id] : null;

    if (!$id) {
        throw new \Exception('Page not found', 404);
    }

    return $id;
  }
}