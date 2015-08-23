<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Manager
 *
 * @author miho
 */
class Bc_Application_Theme_Manager {

    protected static $_instance;

    /**
     * Singleton
     * @return Bc_Application_Theme_Manager
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    //------------ FIELDS -------------//
    /**
     * Absolute path to themes
     * @var string
     */
    protected $_themesPath;

    /**
     * Name of theme currentry used
     * 
     * @var string
     */
    protected $_activeThemeName;

    protected $_layout;
    protected $_view;
    //--------- FIELDS END -----------//

    //--------- CONSTRUCTOR ----------//
    
    /**
     * Protected constructor
     */
    protected function  __construct() {
        
    }

    public function initializeTheme()
    {
      $this->getView()->addBasePath($this->getThemesPath() . '/' .$this->getActiveThemeName());
      $this->getLayout()->setLayoutPath($this->getThemesPath() .'/'.$this->getActiveThemeName(). '/layouts');

      $plugins = Bc_Application_Plugin_Manager::getInstance()->getPlugins();

      foreach($plugins as $plugin){
          if( !$plugin->active ) continue;

          $this->getView()->addScriptPath($this->getThemesPath() .'/'. $this->getActiveThemeName() . '/' . $plugin->name);
      }
      
    }


    
    //--------- PROPERTIES -----------//
    public function setThemesPath($value)
    {
        $this->_themesPath = $value;
    }

    public function getThemesPath()
    {
        return $this->_themesPath;
    }

    public function setActiveThemeName($value)
    {
        $this->_activeThemeName = $value;
    }

    public function getActiveThemeName()
    {
        return $this->_activeThemeName;
    }

    public function setLayout(Zend_Layout $layout)
    {
        $this->_layout = $layout;
    }

    /**
     *
     * @return Zend_Layout
     */
    public function getLayout()
    {
        return $this->_layout;
    }

    public function setView(Zend_View_Abstract $value)
    {
        $this->_view = $value;
    }

    /**
     *
     * @return Zend_View_Abstract
     */
    public function getView()
    {
        return $this->_view;
    }
    //----------- PROPERTIES END -----------//
}
?>
