<?php
/**
 * Description of Object
 *
 * @author miho
 */
class Bc_Annotation_Object {

    /**
     * Annotation reader
     * 
     * @var Bc_Annotation_Reader
     */
    protected $_reader;

    /**
     * Handle object.
     * If null then use itself as handle object.
     * @var Bc_Annotation_Object 
     */
    protected $_object;

    public function __construct($object)
    {
        if($object != null){
            $refl = new Zend_Reflection_Class(get_class($object));
            $this->getReader()->setFile($refl->getFileName());
            $this->_object = $object;
        }
    }

    public function __call($name, $args)
    {
        if($this->_object){
            return;
        }

        if(!method_exists($this, $name)){
            require_once('Zend/Exception.php');
            throw new Zend_Exception(sprintf('Method %s not found in class %s', $name, __CLASS__));
        }

        $this->handle($this, $name, $args);

        return call_user_func_array(array($this,$name), $args);
    }

    /**
     *
     * @return Bc_Annotation_Reader
     */
    public function getReader()
    {
        if($this->_reader == null){
            $this->_reader = new Bc_Annotation_Reader();
            $this->_reader->setFile(__FILE__);
        }

        return $this->_reader;
    }

    public function handle($name, $args)
    {
        $object = $this->_object != null ? $this->_object : $this;
        $this->getReader()
             ->handleMethod($object, $name, $args);
    }

}
?>
