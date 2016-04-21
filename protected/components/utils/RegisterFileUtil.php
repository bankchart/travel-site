<?php

class RegisterFileUtil {
    function __construct(){}
    public function registerDefaultFile(){
        $basePath = Yii::app()->baseUrl;

        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/css/tours/reset.css');
        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/bootstrap/css/bootstrap.min.css');
        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/plugin/slick-1.5.7/slick/slick.css');
        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/plugin/slick-1.5.7/slick/slick-theme.css');

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/jquery.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/bootstrap/js/bootstrap.min.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/plugin/slick-1.5.7/slick/slick.min.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/tours/preloading-handle.js', CClientScript::POS_END);
    }
    public function registerScriptFile($path){
        Yii::app()->getClientScript()->registerScriptFile($path, CClientScript::POS_END);
    }
    public function registerCssFile($path){
        Yii::app()->getClientScript()->registerCssFile($path);
    }
}

?>
