<?php  

/**
* 
*/
class Property extends Doctrine_Record
{
  
  public function setTableDefinition()
  {
    $this->hasColumn('name','string', 255);
    $this->hasColumn('value','object');
    $this->index('key_uniq',
       array(
         'fields'=>array('name'),
         'type'=>'unique')
       );
  }
  
  public function setUp()
  {
    $this->actAs('Timestampable');
  }
}


?>