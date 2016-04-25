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
    public function deleteImageFiles()
    {
        echo 'in deleteImageFiles';
        return $this;
    }
}

?>
