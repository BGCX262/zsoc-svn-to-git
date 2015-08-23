<?php
/**
 * Description of Form
 *
 * @author miho
 */
class Bc_Form extends Zend_Form
{
    protected $_eventDispatcher;

    public function init()
    {
        parent::init();
        $event = new Bc_Form_Event(Bc_Form_Event::FORM_INIT_EVENT, $this);
        $event->dispatch();
    }

    public function submit ($data){
        if($this->isValid($data)){
            $event = new Bc_Form_Event(Bc_Form_Event::FORM_SUBMIT_EVENT, $this);
            $event->dispatch();
            return true;
        }

        return false;
    }

    public function isValid($data)
    {
        parent::isValid($data);
        $event = new Bc_Form_Event(Bc_Form_Event::FORM_VALIDATE_EVENT, $this);
        $event->dispatch();
        return !$this->_errorsExist;
    }

    public function getEventDispatcher()
    {
        if($this->_eventDispatcher == null){
            $this->_eventDispatcher = Bc_Event_Dispatcher::getInstance();
        }

        return $this->_eventDispatcher;
    }
}
?>
