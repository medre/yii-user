<?php

class LogoutController extends Controller
{
	public $defaultAction = 'index';
	
	/**
	 * Logout the current user and redirect to returnLogoutUrl.
	 */
	public function actionIndex()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->controller->module->returnLogoutUrl);
	}

}