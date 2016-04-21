<?php

class SiteController extends Controller
{
	public function init(){
		RegisterFileUtil::registerDefaultFile();
		$basePath = Yii::app()->baseUrl;
		Yii::app()->getClientScript()->registerCssFile($basePath .
            '/css/tours/style.css');

	}

	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	// home-site
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionDestination()
	{

	}

	public function actionTypes()
	{

	}

	public function actionOffers()
	{

	}
	public function actionInspireMe()
	{

	}

	public function actionAboutUs()
	{

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
