<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dispatcher
 *
 * @author miho
 */
class Bc_Event_Dispatcher {

    private $_listeners=array();
    
    public function addEventListener($eventType,Bc_Event_Listener $listener){
        if (!isset($this->_listeners[$eventType])){
            $this->_listeners[$eventType] = array();
        }
        array_push($this->_listeners[$eventType],$listener);
    }

    public function dispatchEvent(Bc_Event $event){
        if (isset($this->_listeners[$event->getType()])){
            $type = $event->getType();
            if (is_array($this->_listeners[$type])){
                foreach ($this->_listeners[$type] as $listener){
                    $listener->listen($event);
                }
            }
        }
    }

    protected static $_instance;
    
    /**
     *
     * @return Bc_Event_Dispatcher
     */
    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

}
?>
