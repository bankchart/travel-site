<?php

class AuthenticateController extends Controller
{
    public $layout = '_admin-login';
    public function filters()
    {
        if(!Yii::app()->user->isGuest)
            $this->redirect(array('//adminPanel/index'));

        $basePath = Yii::app()->baseUrl;
		Yii::app()->getClientScript()->registerCssFile($basePath .
            '/themes/admin-panel/bootstrap/css/bootstrap.css');

        Yii::app()->getClientScript()->registerCssFile(
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'
        );

        Yii::app()->getClientScript()->registerCssFile(
        "https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"
        );

        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/themes/admin-panel/dist/css/AdminLTE.min.css');

        Yii::app()->getClientScript()->registerCssFile($basePath .
            '/themes/admin-panel/plugins/iCheck/square/blue.css');

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/themes/admin-panel/plugins/jQuery/jQuery-2.1.4.min.js', CClientScript::POS_END);

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/themes/admin-panel/bootstrap/js/bootstrap.min.js', CClientScript::POS_END);

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/themes/admin-panel/plugins/iCheck/icheck.min.js', CClientScript::POS_END);

        Yii::app()->getClientScript()->registerScriptFile($basePath .
            '/js/_admin-login.js', CClientScript::POS_END);
    }
    public function actionIndex()
    {
        $this->render('_login');
    }
    public function actionAuth()
    {
        echo 'auth';
    }
}

?>
