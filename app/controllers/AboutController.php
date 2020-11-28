<?php

namespace app\controllers;

use core\App;

class AboutController extends AppController
{
  public function indexAction() {
    $this->setMeta('Controller: ' . App::$app->getProperty('site_name'), 'About', 'About');
  }
}
