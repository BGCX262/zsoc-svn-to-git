<?php  

/**
* 
*/
class Plugin extends Doctrine_Record
{
  
  public function setTableDefinition()
  {
    $this->hasColumn('name', 'string', 255, array('type'=>'string', 'length'=>'255'));
    $this->hasColumn('active', 'boolean');
    $this->hasColumn('title', 'string', 255, array('type'=>'string', 'length'=>'255'));
    $this->hasColumn('description', 'string');
    $this->index('name_uniq',array(
        'fields' => array('name'),
        'type'   => 'unique',
      ));
  }
  
  public function setUp()
  {
    $this->actAs('Timestampable');
  }
  
}


?>