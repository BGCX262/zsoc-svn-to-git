<?php
/**
 * Description of User
 *
 * @author miho
 */
class Bc_Sequrity_Dao_User {
    //put your code here

    public function getUserByEmail($email)
    {
        $users  = Doctrine::getTable('User')->createQuery('u')->andWhere('u.email=?',$this->_email)->execute();
        if($users->count() == 0){
            return false;
        }

        return $users->getFirst();
    }

}
?>
