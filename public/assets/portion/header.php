<?php require_once __DIR__ . '/../../../app/functions/bootstrap.php'; ?>
<?php

use fastmvc\functions\Title; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo Title::getTitle(); ?></title>
  <link rel="stylesheet" href="<?php assets('css/navbar.css'); ?>">
  <link rel="stylesheet" href="<?php assets('css/banner.css'); ?>">
</head>

<body>