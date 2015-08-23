<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserGroup
 *
 * @author miho
 */
class UserGroup extends Doctrine_Record{

    public function setTableDefinition()
    {
        $this->hasColumn('name','string',255);
        $this->hasColumn('description','stirng');
    }

    public function setUp()
    {
        $this->actAs('Timestampable');

        $this->hasMany('User as Users',array(
            'local' => 'id',
            'foreign' => 'group_id'
        ));
    }

}
?>
