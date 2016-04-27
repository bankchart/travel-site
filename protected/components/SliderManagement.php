<?php

class SliderManagement implements SliderInterface
{
    private $path;
    private $sliderModel;
    private $limit = 10;
    private $offset = 0;
    /*
        query slider
        update slider-name
        update image-text-over-slide
        change image-in-slider
        remove image-text-over-slide -> image -> slider & remove file(s)
    */
    public function __construct($path, SliderModel $sliderModel)
    {
        if($path == null)
            $this->path = TravelConst::SLIDER_PATH;
        $this->sliderModel = $sliderModel;
    }
    public function querySlider($condition, array $params, $order, $limit, $offset)
    {
        $criteria = new CDbCriteria;
        if($condition != null){
            $criteria->condition = $condition;
            $criteria->params = $params;
        }
        $criteria->limit = $limit == null ? $this->limit : $limit;
        $criteria->offset = $offset == null ? $this->offset : $offset;
        $criteria->order = $order;
        return $this->sliderModel->findAll($criteria);
    }
    public function updateSlider()
    {
        echo 'in updateSlider<br/>';
        return $this;
    }
    public function updateImageSlider()
    {
        echo 'in updateimageSlider<br/>';
        return $this;
    }
    public function deleteSlide($multi_delete = false, $ids = array())
    {
        // $detail = '';
        // echo $this->sliderModel->slider_name . '<br/>';
        // foreach($this->sliderModel->image_text as $record){
        //     $detail .= 'image-text-id : ' . $record->image_text_id;
        //     $detail .= ', slider_id : ' . $record->slider_id;
        //     $detail .= ', image_id : ' . $record->image_id;
        //     $detail .= 'content-text : ' . $record->content_text;
        //     $detail .= ', lastest-update : ' . $record->lastest_update . '<br/>';
        // }
        // echo $detail;

        $connection = Yii::app()->db;
        $transaction = $connection->beginTransaction();
        try{
            if(!$multi_delete){
                $condition = 'slider_id = :sid';
                $params = array(':sid' => $this->sliderModel->slider_id);
                ImageTextOverModel::model()->deleteAll($condition, $params);
                SliderModel::model()->deleteByPk($this->sliderModel->slider_id);
            }else{
                $temp = array();
                for($i=0;$i<count($ids);$i++)
                    $temp[$i] = ':id' . $i;
                $slides_id = implode(',', $temp);

                $condition = 'slider_id IN ('.$slides_id.')';
                $param_ids = array();
                for($i=0;$i<count($ids);$i++)
                    $param_ids[':id' . $i] = $ids[$i];
                ImageTextOverModel::model()->deleteAll($condition, $param_ids);
                SliderModel::model()->deleteAll($condition, $param_ids);
            }
            $transaction->commit();
            return 'deleted';
        }catch(Exception $ex){
            $transaction->rollback();
            return 'Error message : ' . $ex->getMessage();
        }
    }
}

?>
