<?php

namespace fastmvc\functions;

class Authorized
{


  public static function authorized($condition, $status = Response::NOT_FOUND)
  {
    if (!$condition) {
      self::abort($status);
    }
  }
  protected static function abort($code = 404)
  {
    http_response_code(404);
    require_once "views/{$code}.php";
    die();
  }
}
