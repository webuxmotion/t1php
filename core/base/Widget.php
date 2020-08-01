<?php

namespace core\base;

use core\App;

class Widget
{
  public function block($filePath, $data = null)
  {
    $controllerClass = App::$app->getProperty('controller');
    $controllerClass->block($filePath, $data);
  }
}
