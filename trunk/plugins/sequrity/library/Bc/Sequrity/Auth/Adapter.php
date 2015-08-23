<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Adapter
 *
 * @author miho
 */
class Bc_Sequrity_Auth_Adapter implements Zend_Auth_Adapter_Interface{
    
    protected $_email;
    protected $_password;
    
    public function __construct($email, $password)
    {
        $this->_email = $email;
        $this->_password = $password;
    }

    public function authenticate()
    {
        $users = Doctrine::getTable('User')->createQuery('u')->andWhere('u.email=?',$this->_email)->execute();
        if($users->count()==0){
            return new Zend_Auth_Result(Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND, null);
        }
        $user = $users->getFirst();

        if($user->password == md5($this->_password)){
            return new Zend_Auth_Result(Zend_Auth_Result::SUCCESS, new Bc_Sequrity_Identity($this->_email));
        }

    }
}
?>
