<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'user-form',
    'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>
	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

    <div style="float:left;width:50%">
        <div class="row">
            <?php echo $form->textFieldControlGroup($model,'username',array('size'=>20,'maxlength'=>20)); ?>

        </div>

        <div class="row">
            <?php echo $form->passwordFieldControlGroup($model,'password',array('size'=>60,'maxlength'=>128)); ?>

        </div>

        <div class="row">
            <?php echo $form->textFieldControlGroup($model,'email',array('size'=>60,'maxlength'=>128)); ?>

        </div>

        <div class="row">
            <?php echo $form->dropDownListControlGroup($model,'superuser',User::itemAlias('AdminStatus')); ?>

        </div>

        <div class="row">

            <?php echo $form->dropDownListControlGroup($model,'status',User::itemAlias('UserStatus')); ?>

        </div>
    </div>

    <div style="float:right;width:50%">
<?php 
		$profileFields=Profile::getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownListControlGroup($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textFieldControlGroup($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>

	</div>

			<?php
			}
		}
?>
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