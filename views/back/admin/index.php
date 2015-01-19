<?php

$this->pageTitle = UserModule::t("Manage Users");

$this->breadcrumbs=array(
	UserModule::t('Users')=>array('/user'),
	UserModule::t('Manage'),
);

$this->menu=array(
    array('label'=>UserModule::t('Create User'), 'url'=>array('create')),
    array('label'=>UserModule::t('Manage Users'), 'url'=>array('admin')),
    array('label'=>UserModule::t('Manage Profile Field'), 'url'=>array('profileField/admin')),
);

?>

<?php $this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'user-grid',
    'type' => BsHtml::GRID_TYPE_BORDERED . ' ' . BsHtml::GRID_TYPE_HOVER,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'selectableRows' => 1,
    'selectionChanged' => 'function(id){ location.href = "' . $this->createUrl('admin/view') . '/"+$.fn.yiiGridView.getSelection(id);}',
    'columns'=>array(

		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),
		'create_at',
		'lastvisit_at',
		array(
			'name'=>'superuser',
			'value'=>'User::itemAlias("AdminStatus",$data->superuser)',
			'filter'=>User::itemAlias("AdminStatus"),
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
		),
	),
)); ?>
