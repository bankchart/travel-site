<?php

class TestController extends Controller
{
    public function init(){
		RegisterFileUtil::registerDefaultFile();
        $basePath = Yii::app()->baseUrl;
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/test/test.js', CClientScript::POS_END);
        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/css/tours/test-style.css');
    }
    public function actionIndex(){
        $this->render('index');
    }
}

?>
