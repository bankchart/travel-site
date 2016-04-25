<?php

class AdminPanelController extends Controller
{
    public $layout = '_admin-panel';
    private $limit_size = 20;// 20Mb
    public function filters()
    {
        if(Yii::app()->user->isGuest)
            $this->redirect(array('//Authenticate/index'));

        $basePath = Yii::app()->baseUrl;
		Yii::app()->getClientScript()->registerCssFile($basePath .
            '/themes/admin-panel/bootstrap/css/bootstrap.css');

        Yii::app()->getClientScript()->registerCssFile(
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'
        );

        Yii::app()->getClientScript()->registerCssFile(
        "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
        );

        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/themes/admin-panel/dist/css/AdminLTE.min.css');

        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/themes/admin-panel/dist/css/skins/skin-blue.min.css');

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/themes/admin-panel/plugins/jQuery/jQuery-2.1.4.min.js', CClientScript::POS_END);

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/themes/admin-panel/bootstrap/js/bootstrap.min.js', CClientScript::POS_END);

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/themes/admin-panel/dist/js/app.min.js', CClientScript::POS_END);
    }

    public function actionIndex()
    {
        $this->render('index');
    }
    public function actionAddSliderForm()
    {
        $basePath = Yii::app()->baseUrl;
        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/css/tours/_add-slider.css');
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/tours/_add-slider.js', CClientScript::POS_END);

        $this->render('_add-slider');
    }
    public function actionAddSliderPreview()
    {
        $files = isset($_FILES['slider-images']) ? $_FILES['slider-images'] : null;
        if(isset($files)){
            $path = 'images/temp_preview_images';

            RmFileDir::recursiveRmDirectory($path);

            $file_post = $files;
            $arr = array();
            $file_array = array();
            $file_count = count($file_post['name']);
            $file_keys = array_keys($file_post);

            for ($i=0; $i<$file_count; $i++) {
                foreach ($file_keys as $key) {
                    if(($key == 'error' && $file_post[$key][$i] !== UPLOAD_ERR_OK) ||
                        ($this->limit_size <  (is_int($file_post[$key][$i]) ?
                        $file_post[$key][$i] : 0) / 1048576 && $key == 'size' ||
                        (is_int($file_post[$key][$i]) ?
                        $file_post[$key][$i] : 0) <= -1) ){
                        echo CJSON::encode(array('result_upload' => 'failed'));
                        exit;
                    }
                    $file_array[$i][$key] = $file_post[$key][$i];
                }
            }
            /* start: move file to temp-dir */
            $result = array();
            for($i=0;$i<count($file_array);$i++){

                if (($file_array[$i]["type"] != "image/pjpeg") AND
                    ($file_array[$i]["type"] != "image/jpeg") AND
                    ($file_array[$i]["type"] != "image/png") AND
                    ($file_array[$i]["type"] != "image/gif")){
                    echo CJSON::encode(array('result_upload' => "The image must be in either GIF ,
                    JPG or PNG format. Please upload a JPG or PNG instead."));
                    exit;
                }elseif(!is_uploaded_file($file_array[$i]['tmp_name'])){
                    //You may be attempting to hack our server. We're on to you; expect a knock on the door sometime soon.
                    echo CJSON::encode(array('result_upload' => "failed : You may be attempting to hack our server.
                    We're on to you; expect a knock on the door sometime soon."));
                    exit;
                }

                $dest = $path . '/' . str_replace('.', '0', microtime());

                if(!is_dir($path))
                    mkdir($path);

                move_uploaded_file($file_array[$i]['tmp_name'], str_replace(' ', '0', $dest));
                array_push($result, Yii::app()->baseUrl . '/' . str_replace(' ', '0', $dest));
            }
            /* end: move file temp-dir */
            echo CJSON::encode($result);
        }else{
            echo CJSON::encode(array(
                'result_upload' => 'fail'
            ));
        }
    }
    public function actionAddSlider(){
        if(isset($_POST['slider-name']) &&
            isset(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH']) &&
            isset($_FILES)){
            $sliderName = $_POST['slider-name'];
            $confirmSubmit = $_POST['confirm-submit'];
            if($sliderName !== '' && $confirmSubmit == 'submit'){
                $sliderName = $_POST['slider-name'];
                $files = $_FILES['slider-images'];
            }else{
                echo 'failed';
            }
        }else{
            $this->render('index');
        }
    }
    public function actionEditHome()
    {
        $basePath = Yii::app()->baseUrl;
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/tours/_edit-home.js', CClientScript::POS_END);
        $this->render('_edit-home');
    }
    public function actionEditDestination()
    {
        $this->render('_edit-home');
    }
    public function actionEditTypes()
    {
        $this->render('_edit-types');
    }
    public function actionEditOffers()
    {
        $this->render('_edit-home');
    }
    public function actionEditInspireMe()
    {
        $this->render('_edit-home');
    }
    public function actionEditAboutus()
    {
        $this->render('_edit-home');
    }
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(array('//Authenticate/index'));
    }
    public function actionError()
	{
        echo 'xxx';
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
}

?>
