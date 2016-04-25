<?php

interface SliderInterface
{
    /*
        query slider
        update slider-name
        update image-text-over-slide
        change image-in-slider
        remove image-text-over-slide -> image -> slider & remove file(s)
    */
    public function querySlider(CDbCriteria $criteria);
    public function updateSlider();
    public function updateImageSlider();
    public function deleteImageFiles();
}

?>
