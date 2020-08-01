<?php

namespace core\base;

use core\App;

class View 
{
  public $route;
  public $controller;
  public $model;
  public $view;
  public $layout;
  public $prefix;
  public $data = [];
  public $meta = [];

  public function __construct($route, $layout = '', $view = '', $meta) {
    $this->route = $route;
    $this->controller = $route['controller'];
    $this->view = $view;
    $this->prefix = $route['prefix'];
    $this->meta = $meta;

    if ($layout === false) {
      $this->layout = false;
    } else {
      $this->layout = $layout ?: LAYOUT;
    }
  }

  public function render($data) {
    Lang::load(App::$app->getProperty('lang')['code'], $this->route);

    if (is_array($data)) {
      extract($data);
    }

    $viewFile = APP . "/views/{$this->prefix}{$this->controller}/{$this->view}.php";
    $viewFile = preg_replace('/\\\/', '/', $viewFile);
    

    if (is_file($viewFile)) {
      ob_start();
      $lang = App::$app->getProperty('lang')['code'];
      require $viewFile;
      $content = ob_get_clean();
    } else {
      throw new \Exception("View $viewFile not found", 500);
    }
    
    if (false !== $this->layout) {
      $layoutFile = APP . "/views/layouts/{$this->layout}.php"; 

      if (is_file($layoutFile)) {
        require $layoutFile; 
      } else {
        throw new \Exception("Layout $layoutFile not found", 500);
      }
    }
  }

  public function block($filePath, $data = null) {
    $controllerClass = App::$app->getProperty('controller');
    $controllerClass->block($filePath, $data);
  }

  public function getMeta() {
    $output = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
    $output .= '<meta name="description" content="' . $this->meta['desc'] . '">' . PHP_EOL;
    $output .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;

    return $output;
  }

}
?>
