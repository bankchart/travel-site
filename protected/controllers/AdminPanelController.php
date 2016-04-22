<?php

class AdminPanelController extends Controller
{
    public $layout = '_admin-panel';
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
        $this->render('_edit-home');
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
}

?>
