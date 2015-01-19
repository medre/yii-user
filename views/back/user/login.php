<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    //        'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => true,
    'id' => 'user_form',
    'htmlOptions' => array()
));
?>
<fieldset>
    <h2><?php echo $this->t('Vidco CMS (Admin)')  ?></h2>
    <hr class="colorgraph">
    <?php echo CHtml::errorSummary($model); ?>
    <div class="form-group">
        <?php echo $form->textField($model, 'username', array('autofocus'=>'autofocus','class' => 'input-lg', 'placeholder' => $this->t('User name'), 'prepend' => BsHtml::icon(BsHtml::GLYPHICON_USER))); ?>
    </div>
    <div class="form-group">
        <?php echo $form->passwordField($model, 'password', array('autocomplete'=>'off', 'class' => 'input-lg', 'placeholder' => $this->t('Password'), 'prepend' => BsHtml::icon(BsHtml::GLYPHICON_LOCK))); ?>
    </div>
    <hr class="colorgraph">
    <div class="row" style="text-align:center">
        <div class="col-xs-6 col-sm-6 col-md-6" style="float:none;">
            <button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-check"></i> <?php echo $this->t('Login')  ?>
            </button>
        </div>
    </div>
</fieldset>
<?php
$this->endWidget();
?>
