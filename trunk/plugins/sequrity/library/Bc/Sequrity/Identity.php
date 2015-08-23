<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Bc_Sequrity_Identity {

    protected $_email;
    protected $_id;

    protected $_properties;
    
    public function __construct($email)
    {
       $this->_email = $email;
    }
}
?>
