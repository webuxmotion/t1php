<?php

namespace app\controllers;


use core\base\Controller;
use app\models\AppModel;
use core\App;


class AppController extends Controller
{
  public function __construct($route) {
    parent::__construct($route);

    new AppModel();

    $cache = \Cache::instance();
    
    $langs = $cache->get('lang');
    if (!$langs) {
      $db_langs = \Lang::getLangs();
      $cache->set('lang', $db_langs, 3600 * 24);
      App::$app->setProperty('langs', $db_langs);
    } else {
      App::$app->setProperty('langs', $langs);
    }
    
    App::$app->setProperty('lang', \Lang::getLang(App::$app->getProperty('langs')));
  }
}
