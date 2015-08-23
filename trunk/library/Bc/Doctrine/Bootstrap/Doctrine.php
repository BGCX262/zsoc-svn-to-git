<?php  

/**
* 
*/
class Bc_Doctrine_Bootstrap_Doctrine extends Zend_Application_Resource_ResourceAbstract
{
  
  protected $_schemaPath;
  protected $_modelsPath;
  
  public function init()
  {
    $options = $this->getOptions();
    
    if(isset($options['configFile'])){
      $config = new Zend_Config_Ini($options['configFile']);
      $config = $config->toArray();
    }else{
      $config = array();
    }
    
    require_once('Doctrine.php');
    spl_autoload_register(array('Doctrine','autoload'));
    
    $manager = Doctrine_Manager::getInstance();    
    $manager->setAttribute(Doctrine::ATTR_MODEL_LOADING, Doctrine::MODEL_LOADING_CONSERVATIVE);
    Zend_Registry::set('db_manager', $manager);
    
    if(isset($config['uri'])){
      $connection = Doctrine_Manager::connection($config['uri']);
    }
    
    if(isset($config['modelsPath'])){
      $this->_modelsPath = $config['modelsPath'];
      Doctrine::loadModels($this->_modelsPath);
    }

    if(isset($config['schemaPath'])){
      $this->_schemaPath = $config['schemaPath'];
    }

    return $this;
    
  }
  
  public function getSchemaPath(){
    return $this->_schemaPath;
  }
  
  public function getModelsPath(){
    return $this->_modelsPath;
  }

}


?>