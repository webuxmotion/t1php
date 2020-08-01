<?php

namespace core;

class Router 
{
  protected static $routes = [];
  protected static $route = [];

  public static function add($regexp, $route = []) {
    self::$routes[$regexp] = $route; 
  }

  public static function dispatch($url) {

    
    $url = self::removeQueryString($url);

    App::$app->setProperty('url', $url);
    
    if ( self::matchRoute($url) ) { 
      $controller = 'app\controllers\\' . self::$route['prefix'] . self::$route['controller'] . 'Controller';
      $action = self::$route['action'];
      $errorController = 'app\controllers\\' . self::$route['prefix'] . 'ErrorController'; 

      if (!class_exists($controller) && !DEBUG) {
        $controller = $errorController;
        self::$route['controller'] = 'Error';
        $action = self::$route['action'] ='page404';
      }

      if (class_exists($controller)) {
        $controllerObject = new $controller(self::$route);
        App::$app->setProperty('controller', $controllerObject);
        $action = self::lowerCamelCase($action) . 'Action';
        
        if (!method_exists($controllerObject, $action) && !DEBUG) {
          $controller = $errorController;
          self::$route['controller'] = 'Error';
          self::$route['action'] = 'page404';
          $action = self::$route['action'] . 'Action';
          $controllerObject = new $controller(self::$route);
        }

        if (method_exists($controllerObject, $action)) {
          $controllerObject->$action(); 
          $controllerObject->getView();
        } else {
          throw new \Exception("Method $controller::$action not found", 404);
        }
      } else {
        throw new \Exception("Controller $controller not found", 404);
      }
      return true;
    } else {
      
      throw new \Exception('Page not found', 404);
    }
  }

  public static function matchRoute($url) {
    foreach (self::$routes as $pattern => $route) {
      
      if (preg_match("#{$pattern}#i", $url, $matches)) {
        foreach ($matches as $k => $v) {
          if (is_string($k)) {
            $route[$k] = $v;
          }
        }
        if (empty($route['action'])) {
          $route['action'] = 'index';
        }
        if (!isset($route['prefix'])) {
          $route['prefix'] = '';
        } else {
          App::$app->setProperty('prefix', $route['prefix']);
          $route['prefix'] .= '\\';
        }
        $route['controller'] = self::upperCamelCase($route['controller']);
        self::$route = $route;
        return true;
      }   
    }
    return false;
  }

  protected static function upperCamelCase($name) {
    $name = str_replace('-', ' ', $name);
    $name = ucwords($name);
    $name = str_replace(' ', '', $name);

    return $name;
  }

  protected static function lowerCamelCase($name) {
    return lcfirst(self::upperCamelCase($name));
  }

  public static function removeQueryString($url) {
    
    if ($url) {
      
      $params = explode('?', $url, 2);

      if (false === strpos($params[0], '=')) {
        return rtrim($params[0], '/');
      }
    }
    return '';
  }
}
