<?php  

/**
* 
*/
class Bc_Application_Plugin_Bootstrap
{
  
  protected $_path;
  protected $_name;
  public function __construct()
  {
  }
  
  protected function _initModels(){
    if(is_dir($this->_path.'/models'))
        Doctrine::loadModels($this->_path.'/models');
  }
  
  public function bootstrap(){
    $this->_initLibrary();
    $this->_initModels();
    $this->_initControllers();
  }
  
  public function _initControllers(){
    Zend_Controller_Front::getInstance()->addControllerDirectory($this->_path . '/controllers', $this->_name);
  }
  
  public function _initLibrary(){
    set_include_path(
      implode(PATH_SEPARATOR, array(
            $this->_path . '/library',
            get_include_path(),
          )
        )
    );

    Zend_Loader_Autoloader::getInstance()->pushAutoloader(array($this,'autoload'));
  }

  public function autoload($class)
  {
      $path = $this->_path . '/library/' . str_replace('_', '/', $class).'.php';
      @include_once($path);
  }
  
  public function setPath($value){
    $this->_path = $value;
  }
  
  public function getPath(){
    return $this->_path;
  }

  public function setName($value)
  {
      $this->_name = $value;
  }
}


?>
