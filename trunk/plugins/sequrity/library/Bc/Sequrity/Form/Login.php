<?php
/**
 * Description of Login
 *
 * @author miho
 */
class Bc_Sequrity_Form_Login extends Bc_Form
{
    const FORM_NAME = 'bc_sequrity_form_login';

    protected $_emailField;
    protected $_passwordField;
    protected $_rememberCheckbox;
    protected $_submitButton;

    public function init()
    {
        $this->addElement($this->getEmailField());
        $this->addElement($this->getPasswordField());
        $this->addElement($this->getRememberCheckBox());
        $this->addElement($this->getSubmitButton());
        $this->setName(self::FORM_NAME);
    }

    public function getEmailField()
    {
        if($this->_emailField == null){
            $this->_emailField = new Zend_Form_Element_Text('email');
            $this->_emailField->setLabel('Login')->setRequired(true)->addValidator(new Zend_Validate_EmailAddress());
        }

        return $this->_emailField;
    }

    /**
     *
     * @return Zend_Form_Element_Password
     */
    public function getPasswordField()
    {
        if($this->_passwordField == null){
            $this->_passwordField = new Zend_Form_Element_Password('password');
            $this->_passwordField->setLabel('Password')->setRequired(true)->addValidator(new Zend_Validate_NotEmpty());
        }

        return $this->_passwordField;
    }

    public function getRememberCheckBox()
    {
        if($this->_rememberCheckbox == null){
            $this->_rememberCheckbox = new Zend_Form_Element_Checkbox('remember');
            $this->_rememberCheckbox->setLabel('Remember me');
        }

        return $this->_rememberCheckbox;
    }

    public function getSubmitButton(){
        if($this->_submitButton == null){
            $this->_submitButton = new Zend_Form_Element_Submit('submit');
        }

        return $this->_submitButton;
    }
}
?>
