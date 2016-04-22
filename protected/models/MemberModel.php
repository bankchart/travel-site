<?php

class MemberModel extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'member_tb';
    }
    public function attributeLabels()
    {
        return array(
            'member_id' => 'Member id',
            'username' => 'Username',
            'password' => 'Password',
            'fullname' => 'Fullname',
            'email' => 'email',
            'signup_datetime' => 'Sign up date-time',
            'lastest_signin_datetime' => 'Lastest sign in date-time',
            'level_access_id' => 'Level access id'
        );
    }
    public function relations()
    {
        return array(
            'level' => array(self::HAS_ONE, 'LevelAccessModel', 'level_access_id')
        );
    }
}

?>
