<?php

class AdminPanelController extends Controller
{
    public $layout = '_admin-panel';
    private $limit_size = 20;// 20Mb
    private $_file_version;
    public function filters()
    {
        $this->_file_version = '?v=' . str_replace(' ', '0', microtime());
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
            '/css/tours/_add-slider.css' . $this->_file_version);
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/tours/_add-slider.js' . $this->_file_version, CClientScript::POS_END);

        $this->render('_add-slider');
    }
    public function actionAddSliderPreview()
    {
        if(!isset(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH']))
            exit;
        if(isset(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH']))
            if(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
                exit;

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

            if(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
                exit;

            $sliderName = $_POST['slider-name'];
            $confirmSubmit = $_POST['confirm-submit'];
            if($sliderName !== '' && $confirmSubmit == 'submit'){
                //strip_tags, addslashes
                $sliderName = addslashes(strip_tags($_POST['slider-name']));
                $files = $_FILES['slider-images'];

                /* start: move images file to slider-folder. */
                    /* start: check error file */
                foreach($files as $key => $value){
                    if($key == 'error')
                        foreach($value as $error)
                            if($error != 0){
                                echo 'error';
                                exit;
                            }
                }
                    /* end: check error file */

                    /* start: check permission uploading file */
                foreach($files as $key => $value){
                    if($key == 'tmp_name'){
                        foreach($value as $tmp_name)
                            if(!is_uploaded_file($tmp_name)){
                                echo "Can't upload any file.";
                                exit;
                            }
                    }
                }
                    /* end: check permission uploading file */

                    /* start: moving files */
                $fileStore = array();
                for($i=0;$i<count($files['name']);$i++){
                    foreach($files as $key => $value){
                        $fileStore[$i][$key] = $files[$key][$i];
                    }
                }
                $path = 'images/slider';
                if(!is_dir($path))
                    mkdir($path);

                $connection = Yii::app()->db;
                $transaction = $connection->beginTransaction();
                try{
                    $checkDuplicate =  SliderModel::model()->find(array(
                        'condition' => 'slider_name = :sliderName',
                        'params' => array(':sliderName' => $sliderName)
                    ));

                    if($checkDuplicate != null)
                        throw new Exception('slider name is duplicate.');

                    $sliderModel = new SliderModel;
                    $sliderModel->slider_name = $sliderName;
                    $sliderModel->author_id = Yii::app()->user->id;
                    $sliderModel->create_datetime = new CDbExpression('NOW()');

                    if(!$sliderModel->save())
                        throw new Exception('insert slider failed.');

                    $lastestSliderModel = SliderModel::model()->find(array(
                        'order' => 'slider_id desc'
                    ));

                    foreach($fileStore as $file){
                        $fileName = str_replace(' ', '0', str_replace('.', '0', microtime()));

                        if(move_uploaded_file($file['tmp_name'], $path . '/' . $fileName)){

                            $imageModel = new ImageModel;
                            $imageModel->image_name = $fileName;
                            $imageModel->image_path = $path . '/' . $fileName;
                            $imageModel->upload_datetime = new CDbExpression('NOW()');
                            $imageModel->author_id = Yii::app()->user->id;

                            if(!$imageModel->save())
                                throw new Exception('insert image failed.');

                            $lastestImageModel = ImageModel::model()->find(array(
                                'order' => 'image_id desc'
                            ));

                            $imageTextOverModel = new ImageTextOverModel;
                            $imageTextOverModel->slider_id = $lastestSliderModel->slider_id;
                            $imageTextOverModel->image_id = $lastestImageModel->image_id;
                            $imageTextOverModel->content_text = 'update content please.';
                            $imageTextOverModel->lastest_update = new CDbExpression('NOW()');

                            if(!$imageTextOverModel->save())
                                throw new Exception('insert image text over slide');
                        }
                    }
                    echo 'upload completed.';
                    $transaction->commit();
                }catch(Exception $ex){
                    $transaction->rollback();
                    echo 'upload filed.';
                }
                    /* end: moving files */

                /* end: move images file to slider-folder. */
            }else{
                echo 'failed';
            }
        }else{
            $this->redirect(array('index'));
        }
    }
    public function actionSlideImageListTable()
    {
        $basePath = Yii::app()->baseUrl;
        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/css/tours/_alert-style.css' . $this->_file_version);

        $basePath = Yii::app()->baseUrl;
        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/css/tours/_manage-text-slider.css' . $this->_file_version);
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/tours/_manage-text-slider.js' . $this->_file_version, CClientScript::POS_END);

        $slider = new SliderManagement(null, new SliderModel);
        $limit = 5;
        $offset = 0;
        $tmp = count(SliderModel::model()->findAll())/$limit;
        $pages = is_float($tmp) ? intval($tmp) + 1 : $tmp;
        $selectPageHtml = '';
        for($i=1;$i<=$pages;$i++){
            $selected = $limit != $i ?:'selected';
            $selectPageHtml .= "
                <option $selected value='$i'>$i</option>
            ";
        }
        $model = $slider->querySlider(null, array(), 'create_datetime desc', $limit, $offset);
        $attributeLabels = SliderModel::model()->attributeLabels();
        $this->render('_slide-image-list-table', array(
            'model' => $model,
            'attributeLabels' => $attributeLabels,
            'limit' => $limit,
            'offset' => $offset,
            'selectPage' => $selectPageHtml
        ));
    }
    public function actionSlideImageListTableAjax()
    {
        if(isset(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH'])){
            if(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'){
                echo CJSON::encode(array('fail XMLHttpRequest'));
                exit;
            }
            if(isset($_POST['show-records']) && isset($_POST['show-page']) && isset($_POST['slider-search'])){
                $show_records = filter_input(INPUT_POST, 'show-records', FILTER_SANITIZE_NUMBER_INT);
                $show_page = filter_input(INPUT_POST, 'show-page', FILTER_SANITIZE_NUMBER_INT);
                $search = trim(filter_input(INPUT_POST, 'slider-search',
                            FILTER_SANITIZE_FULL_SPECIAL_CHARS));

                if($show_records <= 0 || $show_page < 0){
                    echo CJSON::encode(array('fail show record | show page.'));
                    exit;
                }

                $slider = new SliderManagement(null, new SliderModel);
                $limit = $show_records;
                $offset = $show_records * $show_page - $show_records;
                $tmp = count(SliderModel::model()->findAll())/$limit;
                $pages = is_float($tmp) ? intval($tmp) + 1 : $tmp;
                $selectPageHtml = '';
                for($i=1;$i<=$pages;$i++){
                    $selected = $show_page != $i ?:'selected';
                    $selectPageHtml .= "
                        <option $selected value='$i'>$i</option>
                    ";
                }
                $condition = null;
                $params = array();

                /* parameter: querySlider($condition, array $params, $order, $limit, $offset) */
                if($search != ""){
                    $condition = "slider_name LIKE '%$search%'";

                }
                $model = $slider->querySlider($condition, $params, 'create_datetime desc', $limit, $offset);
                $record_info = "Showing " . ($offset + 1) . " to ";
                $record_info .= count($model)<$limit?count($model)+$offset . " of ":$limit+$offset . " of ";
                $record_info .= count(SliderModel::model()->findAll()) . " entries";

                if($search != ""){
                    $tempModel = SliderModel::model()->findAll(array(
                        'condition' => 'slider_name LIKE "%'.$search.'%"'
                    ));
                    $tmp = count($tempModel)/$limit;
                    $pages = is_float($tmp) ? intval($tmp) + 1 : $tmp;
                    $pages = $pages>0 ? $pages : 1;
                    $selectPageHtml = '';
                    for($i=1;$i<=$pages;$i++){
                        $selected = $show_page != $i ?:'selected';
                        $selectPageHtml .= "
                            <option $selected value='$i'>$i</option>
                        ";
                    }
                    $record_info = "Showing " . ($offset + 1) . " to ";
                    $record_info .= count($model)<$limit?count($model)+$offset . " of ":$limit+$offset . " of ";
                    $record_info .= count($tempModel) . " entries";
                }
                if(count($model) == 0)
                    $record_info = 'slider empty.';

                echo CJSON::encode(array(
                            'slider_content_partial' => $this->renderPartial('_slider-tbody-partial',
                                array(
                                    'model' => $model,
                                    'limit' => $limit,
                                    'offset' => $offset
                                    ), true),
                            'selectPage' => $selectPageHtml,
                            'record_info' => $record_info,
                            'search' => $search
                    ));
            }else{
                echo CJSON::encode(array('fail input_post'));
                exit;
            }
        }else{
            $this->redirect(array('textoverslideform'));
        }
    }
    public function actionUpdateTextSliderForm($slider_id){
        $this->render('_update-text-slide-form', array(
            'slide' => $slider_id
        ));
    }
    public function actionRemoveSliderAjax(){
        if(isset(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH'])){
            if(filter_input_array(INPUT_SERVER)['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
                exit;

            if(isset($_POST['slider_id'])){
                /*
                * FILTER_SANITIZE_NUMBER_INT
                * Remove all characters except digits, plus and minus sign.
                */
                if(strpos($_POST['slider_id'], '"') !== false){
                    if($_POST['slider_id'] == '""')
                        exit;
                    $temp = explode('&', str_replace('sliders=', '',
                                str_replace('"', '', $_POST['slider_id'])));
                    $ids = array();
                    $index = 0;
                    foreach($temp as $n){
                        $temp_id = trim(filter_var($n,
                                        FILTER_SANITIZE_NUMBER_INT));
                        $temp_id = str_replace('+', '', $temp_id);
                        $temp_id = str_replace('-', '', $temp_id);
                        $ids[$index] = $temp_id;
                        $index++;
                    }
                    $delete = new SliderManagement(null, new SliderModel);
                    echo $delete->deleteSlide(true, $ids);
                    exit;
                }
                $slider_id = $_POST['slider_id'];
                $slider_id = trim(filter_input(INPUT_POST, 'slider_id',
                                FILTER_SANITIZE_NUMBER_INT));
                $slider_id = str_replace('+', '', $slider_id);
                $slider_id = str_replace('-', '', $slider_id);
                $sliderModel = SliderModel::model()->findByPk($slider_id);
                if($sliderModel === null)
                    $sliderModel = new SliderModel;
                $delete = new SliderManagement(null, $sliderModel);
                echo $delete->deleteSlide();
            }
        }else{
            exit;
        }
    }
    public function actionEditHome()
    {
        $basePath = Yii::app()->baseUrl;
        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/tours/_edit-home.js' . $this->_file_version, CClientScript::POS_END);
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
