<?php

namespace app\widgets\lang;

use core\App;
use core\base\Widget;

class Lang extends Widget
{
  protected $tpl;
  protected $langs;
  protected $lang;

  public function __construct($params = null) {

    if (isset($params)) {
      if (isset($params['tpl'])) {
        $prefix = App::$app->getProperty('prefix');
        if ($prefix) $prefix .= '/';
        $this->tpl = APP . "/views/{$prefix}blocks/{$params['tpl']}/index.php";
      } else {
        $this->tpl = __DIR__ . '/lang_tpl/lang.php';
      }
    } else {
      $this->tpl = __DIR__ . '/lang_tpl/lang.php';
    }

    $this->run();
  }

  protected function run() {
    $this->langs = App::$app->getProperty('langs');
    $this->lang = App::$app->getProperty('lang');
    echo $this->getHtml();
  }

  public static function getLangs() {
    return \R::getAssoc("SELECT code, id, name FROM lang ORDER BY code DESC");
  }

  public static function getLang($langs) {
    if (
      isset($_COOKIE['lang']) &&
      array_key_exists($_COOKIE['lang'], $langs)
    )
    {
      $key = $_COOKIE['lang'];
    } else {

      if (DEFAULT_LANG) {
        $key = DEFAULT_LANG;
      } else {
        $key = key($langs);
      }

    }

    $lang = $langs[$key];
    $lang['code'] = $key;

    return $lang;
  }

  protected function getHtml() {
    ob_start();
    require $this->tpl;
    return ob_get_clean();
  }
}
