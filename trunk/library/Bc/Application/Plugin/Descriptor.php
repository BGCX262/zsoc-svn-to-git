<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Descriptor
 *
 * @author miho
 */
class Bc_Application_Plugin_Descriptor {

    protected $_name;
    protected $_id;
    protected $_description;
    protected $_version;
    protected $_path;

    public function __construct(SimpleXMLElement $xml)
    {
        foreach ($xml as $key => $value) {
           switch ($key) {
                case 'name':
                    $this->setName($value);
                    break;

                case 'id':
                    $this->setId($value);
                    break;

                case 'description':
                    $this->setDescription($value);
                    break;

                case 'version':
                    $this->setVersion($value);
                    break;

                default:
                    break;
            };
        }
    }

    public function setName($value)
    {
        $this->_name = $value;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setId($value)
    {
        $this->_id = $value;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function setDescription($value)
    {
        $this->_description = $value;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setVersion($value)
    {
        $this->_version = $value;
    }

    public function getVersion()
    {
        return $this->_version;
    }

    public function setPath($value)
    {
        $this->_path = $value;
    }

    public function getPath()
    {
        return $this->_path;
    }

    public function getModelsPath()
    {
        return realpath($this->_path . '/models');
    }
}
?>
