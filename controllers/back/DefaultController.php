<?php

class DefaultController extends Controller
{
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        if (Yii::app()->user->isAdmin())
        {
            $this->redirect(array('/user/admin'));
        }

		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'id != 1 AND status>'.User::STATUS_BANNED,
		    ),
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('/user/index',array(
			'dataProvider'=>$dataProvider,
		));
	}

}