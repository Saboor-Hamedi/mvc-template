<?php
define('PORTION', '/assets/portion/');
define('ROOT', '/');

function base_path($path)
{
  return  PORTION . $path;
}
function path($component)
{
  $filePath = "../public/assets/portion/{$component}.php"; // Adjust path if necessary

  if (file_exists($filePath)) {
    require_once $filePath;
  } else {
    // Handle missing component gracefully
    echo "Error: Failed to load component: $component";
  }
}
