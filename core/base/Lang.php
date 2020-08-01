<?php

namespace core\base;

class Lang {

  public static $lang_data = [];
  public static $lang_layout = [];
  public static $lang_view = [];

  public static function load($code, $view) {
    $lang_layout = APP . "/langs/{$code}.php";
    $lang_view = APP . "/langs/{$code}/{$view['controller']}/{$view['action']}.php";

    if (file_exists($lang_layout)) {
      self::$lang_layout = require_once $lang_layout;
    }

    if (file_exists($lang_view)) {
      self::$lang_view = require_once $lang_view;
    }

    self::$lang_data = array_merge(self::$lang_layout, ['page' => self::$lang_view ]);
  }

  public static function get($key, $layoutTranslations) {
    if ($layoutTranslations) {
      return isset(self::$lang_data['page'][$key]) ? self::$lang_data['page'][$key] : 'page__' . $key;
    } else {
      return isset(self::$lang_data[$key]) ? self::$lang_data[$key] : $key;
    }

  }
}