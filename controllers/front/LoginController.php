<?php

class LoginController extends FrontEndController
{
	/**
	 * Displays the login page
	 */
	public function actionIndex()
	{
        global $DATA;

		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
            $model->scenario = 'front';

            $DATA['model'] = $model;

            // collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();


                    if (Yii::app()->user->returnUrl)
                        $this->redirect(Yii::app()->user->returnUrl);
				    else
                        $this->redirect(Yii::app()->controller->module->returnUrl);
				}
			}
			// display the login form
			//$this->render('/user/login',array('model'=>$model));
            $this->display('/user/login',array('model'=>$model));

		}else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit_at = date('Y-m-d H:i:s');
		$lastVisit->save();
	}
}

