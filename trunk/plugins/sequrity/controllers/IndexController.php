<?php
require_once ('Bc/Sequrity/Form/Login.php');
/**
 * Description of IndexController
 *
 * @author miho
 */
class Sequrity_IndexController extends Zend_Controller_Action{

    protected $_loginForm;
    protected $_formHelper;

    public function loginAction()
    {
        $form = $this->_getLoginForm();
        $this->view->loginForm = $form;
    }

    public function authAction()
    {
        //$form = $this->_getLoginForm();
        $form = $this->_getLoginForm();
        
        if(!$form->submit($_POST)){
            $this->_redirect('/sequrity/index/login');
        }

        $result = Zend_Auth::getInstance()->authenticate(
            new Bc_Sequrity_Auth_Adapter($form->getEmailField()->getValue(), $form->getPasswordField()->getValue())
        );

        if($result->getCode() == Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND){
            $form->getPasswordField()->addError('User not found');
            $this->_redirect('/sequrity/index/login');
        }
    }

    /**
     *
     * @return Bc_Sequrity_Form_Login
     */
    protected function _getLoginForm()
    {
        $this->_loginForm = $this->_getFormHelper()->getForm(Bc_Sequrity_Form_Login::FORM_NAME);
        
        if($this->_loginForm == null){
            $this->_loginForm = new Bc_Sequrity_Form_Login();
            $this->_loginForm->setAction($this->getFrontController()->getRouter()->assemble(
                array(
                    'module'=>'sequrity',
                    'controller'=>'index',
                    'action' => 'auth'
                    )
                )
            );

            $this->_getFormHelper()->setForm($this->_loginForm);
        }

        return $this->_loginForm;
    }

    protected function _getFormHelper()
    {
        if($this->_formHelper == null){
            $this->_formHelper = $this->_helper->getHelper('Form');
        }
        
        return $this->_formHelper;
    }
}
?>
