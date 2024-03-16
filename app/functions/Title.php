<?php

namespace fastmvc\functions;

class Title
{
  public static function getTitle()
  {
    // Sanitize URL
    $url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

    // Extract filename without extension
    $pathInfo = pathinfo($url, PATHINFO_FILENAME);

    // Remove ".php" extension if it exists
    $pathInfo = str_replace('.php', '', $pathInfo);

    // Return default title if pathInfo is empty
    if (empty($pathInfo)) {
      return 'Home';
    }

    // Capitalize the first letter of the filename
    return ucfirst($pathInfo);
  }
}
