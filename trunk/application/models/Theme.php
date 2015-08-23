<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Themes
 *
 * @author miho
 */
class Theme extends Doctrine_Record {

    public function setTableDefinition()
    {
        $this->hasColumn('name','string',255);
        $this->hasColumn('description','string',255);
        $this->hasColumn('active','boolean');

        $this->index('name_uniq', array(
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
