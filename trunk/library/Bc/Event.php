<?php
/**
 * Description of Event
 *
 * @author miho
 */
class Bc_Event {

    protected $_type;

    /**
     * Event type
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    public function __construct($type)
    {
        $this->_type = $type;
    }

    public function dispatch(){
        return Bc_Event_Dispatcher::getInstance()->dispatchEvent($this);
    }

}
?>
