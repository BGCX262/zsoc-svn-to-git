<?php

/**
 * Description of Event
 *
 * @author miho
 */
class Bc_Form_Event extends Bc_Event{

    const FORM_INIT_EVENT = 'bc.form.even.init';
    const FORM_VALIDATE_EVENT = 'bc.form.event.validate';
    const FORM_SUBMIT_EVENT = 'bc.form.event.submit';

    protected $_form;

    public function  __construct($type, Bc_Form $form) {
        parent::__construct($type);
        $this->_form = $form;
    }

    public function getForm()
    {
        return $this->_form;
    }

}
?>
