<?php

namespace fastmvc\service;

class Redirect
{

  public static function withMessage($url, $message = null)
  {
    if ($message !== null) {
      $_SESSION['message'] = $message;
    }
    header('Location: ' . $url);
    exit;
  }


  public static function selfLoad()
  {
    // Determine the protocol (http or https) based on the current request
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
    // Construct the full URL using the determined protocol
    $redirectUrl = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $redirectUrl);
    exit;
  }
  public static function displayMessage()
  {
    if (isset($_SESSION['message'])) {
      $message = $_SESSION['message'];
      unset($_SESSION['message']);
      return $message;
    }
    return  null;
  }
}
