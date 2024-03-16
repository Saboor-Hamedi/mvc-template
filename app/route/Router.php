<?php

namespace fastmvc\route;

class Router
{
  private $routes = [];

  public function route($url, $controllerName, $methodName)
  {
    $this->routes[$url] = ['controller' => $controllerName, 'method' => $methodName];
  }

  public function dispatch($url)
  {
    if (array_key_exists($url, $this->routes)) {
      $controllerName = $this->routes[$url]['controller'];
      $methodName = $this->routes[$url]['method'];

      if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $methodName)) {
          $controller->$methodName();
        } else {
          echo "Error: Method $methodName not found in $controllerName";
        }
      } else {
        echo "Error: Controller class $controllerName not found";
      }
    } else {
      echo "Error 404 - Page not found";
    }
  }
}
