<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reader
 *
 * @author miho
 */
class Bc_Annotation_Reader {

    /**
     *
     * @var string 
     */
    protected $_file;

    /**
     * Class loader
     * @var Zend_Loader_PluginLoader
     */
    protected $_loader;

    public function handleMethod($object, $method, $args = null)
    {
        $reflection = new Zend_Reflection_File($this->_file);

        $reflectionClass = $reflection->getClass(get_class($object));

        $reflectionMethod = $reflectionClass->getMethod($method);

        $docblock = $reflectionMethod->getDocblock();

        $tags = $docblock->getTags();

        foreach ($tags as $tag) {
            //$tag = new Zend_Reflection_Docblock_Tag();
            $name = ucfirst($tag->getName());
            $className = $name . 'Annotation';
            var_dump($className);
            try{
                $className = $this->getLoader()->load($className);
                $annotation = new $className;
                $annotation->handle($tag->getDescription(), $object, $args);
            }catch(Zend_Loader_PluginLoader_Exception $e){
                throw $e;
            }
        }

    }

    public function getLoader()
    {
        if($this->_loader == null){
            $this->_loader = new Zend_Loader_PluginLoader();
            $this->_loader->addPrefixPath('Bc_Annotations', 'Bc/Annotations');
        }

        return $this->_loader;
    }

    /**
     *
     * @param string $file
     * @return Bc_Annotation_Reader
     */
    public function setFile($file)
    {
        $this->_file = $file;

        return $this;
    }

    public function getFile()
    {
        return $this->_file;
    }

}
?>
