<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'user-form',
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation'=>true,
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row varname">

		<?php echo (($model->id)?$form->textFieldControlGroup($model,'varname',array('size'=>60,'maxlength'=>50,'readonly'=>true)):$form->textFieldControlGroup($model,'varname',array('size'=>60,'maxlength'=>50))); ?>

		<p class="hint"><?php echo UserModule::t("Allowed lowercase letters and digits."); ?></p>
	</div>

	<div class="row title">
		<?php echo $form->textFieldControlGroup($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<p class="hint"><?php echo UserModule::t('Field name on the language of "sourceLanguage".'); ?></p>
	</div>

	<div class="row field_type">
		<?php echo (($model->id)?
            $form->dropDownListControlGroup($model,'field_type',array('size'=>60,'maxlength'=>50,'readonly'=>true,'id'=>'field_type')) :
            $form->dropDownListControlGroup($model,'field_type',ProfileField::itemAlias('field_type'),array('id'=>'field_type'))); ?>
		<p class="hint"><?php echo UserModule::t('Field type column in the database.'); ?></p>
	</div>

	<div class="row field_size">
		<?php echo (($model->id)?
            $form->textFieldControlGroup($model,'field_size',array('readonly'=>true)):
            $form->textFieldControlGroup($model,'field_size')); ?>
		<p class="hint"><?php echo UserModule::t('Field size column in the database.'); ?></p>
	</div>

	<div class="row field_size_min">
		<?php echo $form->textFieldControlGroup($model,'field_size_min'); ?>
		<p class="hint"><?php echo UserModule::t('The minimum value of the field (form validator).'); ?></p>
	</div>

	<div class="row required">
		<?php echo $form->dropDownListControlGroup($model,'required',ProfileField::itemAlias('required')); ?>
		<p class="hint"><?php echo UserModule::t('Required field (form validator).'); ?></p>
	</div>

	<div class="row match">
		<?php echo $form->textFieldControlGroup($model,'match',array('size'=>60,'maxlength'=>255)); ?>
		<p class="hint"><?php echo UserModule::t("Regular expression (example: '/^[A-Za-z0-9\s,]+$/u')."); ?></p>
	</div>

	<div class="row range">
		<?php echo $form->textFieldControlGroup($model,'range',array('size'=>60,'maxlength'=>5000)); ?>
		<p class="hint"><?php echo UserModule::t('Predefined values (example: 1;2;3;4;5 or 1==One;2==Two;3==Three;4==Four;5==Five).'); ?></p>
	</div>

	<div class="row error_message">
		<?php echo $form->textFieldControlGroup($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
		<p class="hint"><?php echo UserModule::t('Error message when you validate the form.'); ?></p>
	</div>

	<div class="row other_validator">
		<?php echo $form->textFieldControlGroup($model,'other_validator',array('size'=>60,'maxlength'=>255)); ?>
		<p class="hint"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('file'=>array('types'=>'jpg, gif, png'))))); ?></p>
	</div>

	<div class="row default">
		<?php echo (($model->id) ?
            $form->textFieldControlGroup($model,'default',array('size'=>60,'maxlength'=>255,'readonly'=>true)):
            $form->textFieldControlGroup($model,'default',array('size'=>60,'maxlength'=>255))); ?>
		<p class="hint"><?php echo UserModule::t('The value of the default field (database).'); ?></p>
	</div>

	<div class="row widget">
		<?php
		list($widgetsList) = ProfileFieldController::getWidgets($model->field_type);
		    echo $form->dropDownListControlGroup($model,'widget',$widgetsList,array('id'=>'widgetlist'));

        ?>
		<p class="hint"><?php echo UserModule::t('Widget name.'); ?></p>
	</div>

	<div class="row widgetparams">
		<?php $form->textFieldControlGroup($model,'widgetparams',array('size'=>60,'maxlength'=>5000,'id'=>'widgetparams')); ?>
		<p class="hint"><?php echo UserModule::t('JSON string (example: {example}).',array('{example}'=>CJavaScript::jsonEncode(array('param1'=>array('val1','val2'),'param2'=>array('k1'=>'v1','k2'=>'v2'))))); ?></p>
	</div>

	<div class="row position">
		<?php $form->textFieldControlGroup($model,'position'); ?>
		<p class="hint"><?php echo UserModule::t('Display order of fields.'); ?></p>
	</div>

	<div class="row visible">
		<?php echo $form->dropDownListControlGroup($model,'visible',ProfileField::itemAlias('visible')); ?>
	</div>

	<div style="clear:both"></div>
    <hr/>
	<div class="row buttons">
		<?php echo BsHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'),array(
            'color' => BsHtml::BUTTON_COLOR_SUCCESS
        )); ?>
	</div>

    <?php $this->endWidget(); ?>

</div><!-- form -->
<div id="dialog-form" title="<?php echo UserModule::t('Widget parametrs'); ?>">
	<form>
	<fieldset>
		<label for="name">Name</label>
		<input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all" />
		<label for="value">Value</label>
		<input type="text" name="value" id="value" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
