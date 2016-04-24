<?php

class ImageTextOverModel extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'image_text_over_tb';
    }
    public function attributeLabels(){
        return array(
            'image_text_id' => 'Image text id',
            'slider_id' => 'Slider id',
            'image_id' => 'Image id',
            'content_text' => 'Content text',
            'lastest_update' => 'Lastest update' // with create datetime
        )
    }
}

?>
