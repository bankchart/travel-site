<?php

class ImageModel extends CActiveRecord
{
    public static function model($className=__CLASS_)
    {
        return parent::model($className);
    }
    public function tableName()
    {
        return 'image_tb';
    }
    public function attributeLabels()
    {
        return array(
            'image_id' => 'Image id',
            'image_name' => 'Image name',
            'image_path' => 'Image path',
            'upload_datetime' => 'Upload datetime',
            'author_id' => 'Author id'
        );
    }
}

?>
