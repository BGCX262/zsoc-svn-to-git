<?php
/**
 * Description of Listener
 *
 * @author miho
 */
class Bc_Event_Listener {
    
    private $_functionName;
    private $_listenObject;
    
    public function __construct($listenObject,$functionName){
        if(!method_exists($listenObject,$functionName)){
            throw new Exception('Wrong event handler function. Function '.$functionName.' does no exists in object'.$listenObject);
        }
        $this->_functionName = $functionName;
        $this->_listenObject = $listenObject;
    }

    public function listen(Event $event){
        $this->_listenObject->{$this->_functionName}($event);
    }

}
?>
