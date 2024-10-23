<?php

spl_autoload_register('autoloader');

function autoloader($className) {
  $className = str_replace('\\', '/', $className);
  $className = $className . '.php';

  if (!file_exists($className)) {
    return false;
  }

  require_once ("$className");
}
