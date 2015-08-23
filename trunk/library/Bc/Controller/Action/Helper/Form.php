<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormHelper
 *
 * @author miho
 */
class Bc_Controller_Action_Helper_Form extends Zend_Controller_Action_Helper_Abstract{

    protected static $_session;

    protected $_namespace = 'bc_controller_action_helper_form';

    public function setForm(Bc_Form $form)
    {
        $formId = $form->getName();
        $session = $this->getSession();
        $session->$formId = $form;
        return $this;
    }

    public function getForm($formId)
    {
        $session = $this->getSession();
        return $session->$formId;
    }

    public function getName()
    {
        return 'Form';
    }

    /**
     *
     * @return Zend_Session_Namespace
     */
    public function getSession(){
        if(self::$_session == null){
            self::$_session = new Zend_Session_Namespace($this->_namespace);
        }

        return self::$_session;
    }

}
?>
