<?php  

/**
* Plugin_Manager Data Access Object
*/
class Bc_Application_Plugin_Dao_ManagerDao
{
  
  public function __construct()
  {
    
  }
  
  public function findPluginsInPath($path){
    $dir = dir($path);
    
    $plugins = array();
    while( false !== ($entry = $dir->read()) ){
      if(strpos($entry,'.') === false || strpos($entry,'..') === false){
        $plugins[] = $entry;
      }
      
    }
    
    return $plugins;
  }

  public function loadDescriptor($path)
  { 
    if(($xml = @simplexml_load_file($path)) === false){
        throw new Bc_Application_Plugin_Dao_Exception('Path '.$path .' not found');
    }
    return new Bc_Application_Plugin_Descriptor($xml);
  }

  public function loadBootstrap($dir, $name){
    $name = ucfirst($name);
    if(file_exists($dir.'/Bootstrap.php')){
       require_once($dir.'/Bootstrap.php');
       if(class_exists($name.'_Bootstrap')){
         $class = $name.'_Bootstrap';
         $bootstrap = new $class;
         return $bootstrap;
       }
     }else{
         return new Bc_Application_Plugin_Bootstrap();
     }
  }

  public function registerPlugin(Bc_Application_Plugin_Descriptor $descriptor)
  {
      if($this->isPluginRegistered($descriptor->getId())){
          return;
      }

      if(is_dir($descriptor->getModelsPath())){
        try{
            Doctrine::createTablesFromModels($descriptor->getModelsPath());
        }catch(Exception $e){
            var_dump($e);
        }
      }


      $plugin = new Plugin();
      $plugin->name = $descriptor->getId();
      $plugin->description = $descriptor->getDescription();
      $plugin->title = $descriptor->getName();
      $plugin->active = true;
      $plugin->save();

      
  }

  public function isPluginRegistered($pluginId){
      return Doctrine_Query::create()->addFrom('Plugin p')->addWhere('p.name=?', $pluginId)->execute()->count() > 0;
  }

  public function getRegisteredPlugins()
  {
      return $plugins = Doctrine_Query::create()->addFrom('Plugin p')->execute();
  }
  
}


?>