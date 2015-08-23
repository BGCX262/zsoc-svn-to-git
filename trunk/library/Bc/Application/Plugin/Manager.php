<?php  

/**
* Plugin Manager
*
*/
class Bc_Application_Plugin_Manager
{
  
  protected static $_instance;

  /**
   *
   * @return Bc_Application_Plugin_Manager
   */
  public static function getInstance(){
    if(self::$_instance == null){
      self::$_instance = new self();
    }
    
    return self::$_instance;
  }
  
  protected $_pluginsPath;
  protected $_dao;
  protected $_registeredPlugins;
  /**
   * Protected constructor
   */
  protected function __construct(){
    //$this->_dao = new Bc_Application_Plugin_Dao_ManagerDao();
  }
  
  public function setPluginsPath($value){
    $this->_pluginsPath = $value;
    return $this;
  }
  
  public function getPluginsPath(){
    return $this->_pluginsPath;
  }
  /**
   * Manager DAO lazy getter.
   * 
   * @return Bc_Application_Plugin_Dao_ManagerDao
   */
  public function getDao(){
    if($this->_dao == null){
      $this->_dao = new Bc_Application_Plugin_Dao_ManagerDao();
    }
    
    return $this->_dao;
  }

  /**
   * This function registers all plugins that not registered
   */
  public function registerPlugins(){
    if($this->_pluginsPath == null){
      throw new Exception('pluginPath shoud be setted');
    }
    echo($this->_pluginsPath);
    $plugins = $this->getDao()->findPluginsInPath($this->getPluginsPath());

    foreach ($plugins as $plugin) {
      $path = realpath($this->getPluginsPath() . '/' .$plugin);
      try{
        $descriptor = $this->getPluginDescriptor($path);
        $descriptor->setPath($path);
        $this->getDao()->registerPlugin($descriptor);
      }catch(Bc_Application_Plugin_Dao_Exception $e){
          //var_dump($e);
          continue;
      }
    }
exit();
  }

  public function initializePlugins()
  {
      $plugins =  $this->getPlugins();

      foreach ($plugins as $plugin) {
          if($plugin->active){
              $bootstrap = $this->getPluginBootstrap($this->_pluginsPath . '/'.$plugin->name, $plugin->name);
              $bootstrap->bootstrap();
          }
      }
  }
  
  /**
   * Creates bootstrap instance form given $dir and $name
   * 
   * @param string $dir
   * @param string $name
   * @return Bc_Application_Plugin_Bootstrap
   */
  public function getPluginBootstrap($dir, $name){
     if(($bootstrap = $this->getDao()->loadBootstrap($dir, $name)) !== false){
       $bootstrap->setName($name);
       $bootstrap->setPath($dir);
       return $bootstrap;
     }
     
     return false;
  }
  
  public function getPluginDescriptor($dir)
  {
      return $this->getDao()->loadDescriptor($dir.'/info.xml');
  }
  
  public function getPlugins()
  {
      if($this->_registeredPlugins == null){
          $this->_registeredPlugins = $this->getDao()->getRegisteredPlugins();
      }

      return $this->_registeredPlugins;
  }
  
}


?>