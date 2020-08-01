<?php

namespace core;

class App
{
  public static $app;
  
  public function __construct() {
    $query = $_SERVER['REQUEST_URI'];
    $query = trim($query, '/');
    session_start();
    self::$app = Registry::instance();
    $this->getParams();
    new ErrorHandler();
    Router::dispatch($query);
  }

  protected function getParams() {
    $params = require_once CONF . '/params.php';
    if (!empty($params)) {
      foreach($params as $key => $value) {
        self::$app->setProperty($key, $value);
      }
    }
  }
}
