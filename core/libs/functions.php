<?php

function debug($arr) {
  echo '<pre>' . print_r($arr, true) . '</pre>';
}

function redirect($http = false){
  if($http){
      $redirect = $http;
  }else{
      $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
  }
  header("Location: $redirect");
  exit;
}

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES);
}

function getAppPath() {
  $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ?
    'https://' :
    'http://';

  $app_path = "{$protocol}{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
  $app_path = preg_replace("#[^/]+$#", '', $app_path);
  $app_path = str_replace('/public/', '', $app_path);

  return $app_path;
}

function icon($name) {
  $icon = APP . '/views/icons/' . $name . '.svg';
  return file_get_contents($icon);
}

function __($key, $pageTranslations = false) {
  return \core\base\Lang::get($key, $pageTranslations);
}

function load($files, $extention) {
  
  foreach ($files as $file) {
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if ($extention === 'css') {
      if ($ext === $extention) {
        echo '<link rel="stylesheet" href="/dist/' . $file . '">';
      }
    } else if ($extention === 'js') {
      if ($ext === $extention) {
        echo '<script src="/dist/' . $file . '"></script>';
      }
    }
  }
}
