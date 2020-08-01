<?php

namespace app\controllers;

use core\App;

class MainController extends AppController
{
  public function indexAction() {
    $message = 'Hello, User!';
    
    $this->setMeta(App::$app->getProperty('site_name'), 'Description', 'Keyword1, Keyword2');
    $this->set(compact('message'));
  }
}
