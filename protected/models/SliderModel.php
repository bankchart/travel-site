<?php

class SliderModel extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'slider_tb';
    }
    public function attributeLabels()
    {
        return array(
            'slider_id' => 'Slider id',
            'slider_name' => 'Slider name',
            'create_datetime' => 'Created datetime',
            'author_id' => 'Author id'
        );
    }
    public function relations()
    {
        return array(
            'author' => array(self::BELONGS_TO, 'MemberModel', 'author_id')
        );
    }
}

?>
