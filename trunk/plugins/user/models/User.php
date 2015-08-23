<?php

/**
* 
*/
class User extends Doctrine_Record
{
  public function setTableDefinition()
  {
    $this->hasColumn('screenName','string',255);  
    $this->hasColumn('email','string', 255);
    $this->hasColumn('password', 'string',255);
    $this->hasColumn('active', 'boolean');
    $this->hasColumn('isOnline', 'boolean');
    $this->hasColumn('lastLoginDate', 'timestamp');
    $this->hasColumn('group_id','integer');
  }
  
  public function setUp(){
    $this->actAs('Timestampable');

    $this->hasOne('Group',array(
        'local' => 'group_id',
        'foreign' => 'id'
    ));
  }
}


?>