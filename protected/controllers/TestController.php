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
    public function actionCountModel()
    {
        $test = new SliderModel;
        $temp = count($test);
        echo 'count model = ' . $test->slider_name;
    }
    public function actionTestInterface(){
        echo TravelConst::SLIDER_PATH;
        echo '<br/>';

        // $a = new CDbCriteria;
        // $b = new SliderModel;
        // $c = new ImageTextOverModel;
        // $interface = new SliderManagement(null, $b, $c);
        // $interface->querySlider($a)->updateSlider($b);
    }
    public function actionIndex(){
        $this->render('index');
    }
    public function actionGenPassword(){
        $model = MemberModel::model()->find(array(
            'condition' => 'username = "admin"'
        ));
        $pass = $model->password;
        echo $model->username . '<br/>';
        echo $pass . '<br/>';
        echo CPasswordHelper::verifyPassword("123456", $pass) ? 'correct' : 'incorrect';
    }
    public function actionQueryTest()
    {
        $model = LevelAccessModel::model()->findAll();
        foreach($model as $record){
            echo 'level access name : ' . $record->level_access_name . '<br/>';
            $count = 1;
            foreach($record->member as $mem){
                echo $count++ . '. username : ' . $mem->username . '<br/>';
            }
            echo '<hr/>';
        }
        $model = MemberModel::model()->findAll();
        foreach($model as $record){
            echo 'username : ' . $record->username . ', level name : ' .
                $record->level->level_access_name . '<br/>';
        }
    }
    public function actionHttpVerbAjax(){
        echo '<pre>';
        //print_r(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH']);
        print_r(filter_input_array(INPUT_SERVER));
        echo '</pre>';
    }
    public function actionInputFilterTest()
    {
        //var_dump(filter_input(INPUT_GET, 'myvar'));
        echo '<pre>';
        print_r(filter_input_array(INPUT_SERVER));
        echo '</pre>';
    }
}

?>
