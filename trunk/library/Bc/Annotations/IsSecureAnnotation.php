<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IsSecureAnnotation
 *
 * @author miho
 */
class Bc_Annotations_IsSecureAnnotation extends Bc_Annotation{
    //put your code here

    public function handle($value, $context, $method){
        var_dump($value);
    }

}
?>
