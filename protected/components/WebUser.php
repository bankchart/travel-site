<?php

class WebUser extends CWebUser
{
    private $_model;

    function isAdmin(){// auth_id = 1
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->level_access_id) === 1;
    }

    function isSubscriber(){// auth_id = 2
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->auth_id) === 2;
    }

    protected function loadUser($id=null){
        if($this->_model===null){
            $this->_model = MemberModel::model()->findByPk($id);
        }
        return $this->_model;
    }
}

?>
