<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

defined('APPLICATION_PATH')
  ||define('APPLICATION_PATH', 
    realpath(dirname(__FILE__) . '/../application'));

defined('APPLICATION_ENV')
  ||define('APPLICATION_ENV', 
    (
      getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'dev' 
    )
  );


set_include_path(
  implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/library',
    get_include_path(),
    )
  )
);

require_once 'Zend/Application.php';

$application = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/../configs/config.ini');

$application->bootstrap()->run();