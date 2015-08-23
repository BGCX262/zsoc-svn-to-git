<?php
/**
 * Install controller
 *
 * @author miho
 */
class InstallController extends Zend_Controller_Action {

    public function preDispatch()
    {
        $this->getHelper('layout')->setLayout('install');
    }

    public function indexAction()
    {
        Doctrine::createTablesFromModels();
        exit();
    }

    public function registerPluginsAction()
    {
        $manager = Bc_Application_Plugin_Manager::getInstance();
        $manager->registerPlugins();
       
    }

}
?>
