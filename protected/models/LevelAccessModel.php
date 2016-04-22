<?php

class LevelAccessModel extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'level_access_tb';
    }
    public function attributeLabels()
    {
        return array(
            'level_access_id' => 'Level access id',
            'level_access_name' => 'Level access name'
        );
    }
    public function relations()
    {
        return array(
            'member' => array(self::HAS_MANY, 'MemberModel', 'member_id')
        );
    }
}

?>
