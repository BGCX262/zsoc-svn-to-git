<?php  

/**
* 
*/
class IndexController extends Zend_Controller_Action
{
  
  protected $_annotationObject;

  public function preDispatch()
  {
      $this->_annotationObject = new Bc_Annotation_Object($this);

      $action = $this->_request->getActionName();

      $this->_annotationObject->handle($action.'Action', null);
  }

  /**
   * @isSecure true
   */
  public function indexAction()
  {
     
  }
  
  public function dbAction(){
    $bootstrap = $this->getInvokeArg('bootstrap');
    $doctrine = $bootstrap->getResource('doctrine');
   
    Doctrine::createTablesFromModels($doctrine->getModelsPath());
    
  }

  public function __call($name, $args)
  {
        
  }
}


?>