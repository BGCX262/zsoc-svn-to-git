<?php  

/**
* 
*/
class Bc_Application_Bootstrap_Plugin extends Zend_Application_Resource_ResourceAbstract
{

  const OPTION_PLUGINS_PATH = 'pluginsPath';
  const OPTION_THEMES_PATH  = 'themesPath';

  public function init(){
    $bootstrap = $this->getBootstrap();
    $bootstrap->bootstrap('FrontController');
    $bootstrap->bootstrap('View');
    $bootstrap->bootstrap('Layout');
    $front = $bootstrap->getResource('FronController');
    Zend_Controller_Action_HelperBroker::addPrefix('Bc_Controller_Action_Helper');


    $bootstrap->bootstrap('Doctrine');
    $manager = Zend_Registry::get('db_manager');
    
    $options = $this->getOptions();
    
    if(!isset($options[self::OPTION_PLUGINS_PATH])){
      throw new Exception('Bad Config! pluginsPath shoud be setted');
    }
    
    $pluginManager = Bc_Application_Plugin_Manager::getInstance();
    $pluginManager->setPluginsPath($options[self::OPTION_PLUGINS_PATH]);
    $pluginManager->initializePlugins();

    if(!isset($options[self::OPTION_THEMES_PATH])){
        throw new Exception('Bad Config! themesPath shoud be setted');
    }

    $themesManager = Bc_Application_Theme_Manager::getInstance();
    $themesManager->setThemesPath($options[self::OPTION_THEMES_PATH]);
    $themesManager->setView($bootstrap->getResource('View'));
    $themesManager->setActiveThemeName('minimal');
    $themesManager->setLayout($bootstrap->getResource('Layout'));
    $themesManager->initializeTheme();

  }
  
}


?>