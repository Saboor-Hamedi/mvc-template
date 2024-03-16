<?php

namespace fastmvc\functions;

class Escaping
{
  public static function HTMLChars($str, $flags = ENT_QUOTES | ENT_SUBSTITUTE, $encode = 'UTF-8')
  {
    if (is_string($str)) {
      echo htmlspecialchars($str, $flags, $encode);
    } else {
      return '';
    }
  }
  public static function LimitString($str, $limit, $end = '...')
  {
    // check if strin length is less than or equal to the limit
    if (strlen($str) <= $limit) {
      echo $str;
    }
    // cut the string to the limit
    $truncated = mb_substr($str, 0, $limit, 'UTF-8');
    // add the end indicator if string was truncated
    if (strlen($truncated) < strlen($str)) {
      $truncated .= $end;
    }
    echo $truncated;
  }

  // extract time 
  public static function ConvertTime($timestamp)
  {
    $now = time();
    $diff = $now - strtotime($timestamp);

    if ($diff < 60) {
      echo  'Just now';
    } elseif ($diff < 3600) {
      $minutes = floor($diff / 60);
      echo  $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 86400) {
      $hours = floor($diff / 3600);
      echo  $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
    } elseif ($diff < 172800) {
      echo  'Yesterday';
    } else {
      echo  date('M j, Y', strtotime($timestamp));
    }
  }
}
