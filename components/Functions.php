<?php
@session_start();
/**
 * Created by PhpStorm.
 * User: Erdem
 * Date: 22/10/14
 * Time: 12:55
 */

global $CID,$DATA;
$CID  = Yii::app()->controller->id;
$DATA = Yii::app()->session[$CID];

if (!isset($DATA['user']) && !Yii::app()->user->isGuest)
{
    $DATA['user'] = User::model()->findByPk(Yii::app()->user->id);
}

$profileFields = ProfileField::model()->forOwner()->sort()->findAll();

if ($profileFields)
{
    $pfdata = array();
    foreach($profileFields as $profileField)
    {
        $pfdata[$profileField->varname] = $profileField;
    }

    $DATA['profileFields'] = $pfdata;

}else{
    $DATA['profileFields'] = array();
}


function userIsLogged($text){

    //$params = Tools::function_params();

    if (Yii::app()->user->isGuest)
    {
        return Helpers::t($text);
    }

    return '';
}

function userLoginUrl($text){

    //$params = Tools::function_params();

    if (Yii::app()->user->isGuest)
    {
        $loginURL = Yii::app()->getModule('user')->loginUrl;

        if (is_array($loginURL)) $loginURL = current($loginURL);

        return CHtml::link(Helpers::t($text),$loginURL);
    }

    return '';
}

function userLogoutUrl(){

    $params = Tools::function_params();

    if (Yii::app()->user->isGuest == false)
    {
        $logoutURL = Yii::app()->getModule('user')->logoutUrl;

        if (is_array($logoutURL)) $logoutURL = current($logoutURL);

        return CHtml::link($params['text'],$logoutURL);
    }

    return '';
}

function userRegisterLink($text)
{
    $params = Tools::function_params();

    if (Yii::app()->user->isGuest)
    return CHtml::link(UserModule::t($text),Yii::app()->getModule('user')->registrationUrl);
}

function userProfileLink()
{
    $params = Tools::function_params();

    if (!Yii::app()->user->isGuest)
        return CHtml::link(UserModule::t($params['text']),array('/user/profile'));
}

function userLostPasswordLink($text)
{
    $params = Tools::function_params();
    if (Yii::app()->user->isGuest)
    return  CHtml::link(UserModule::t($text),Yii::app()->getModule('user')->recoveryUrl);
}

function userRegisterFormStart()
{
    $params = Tools::function_params();

    global $DATA;
    return  CHtml::beginForm($params['action'],$params['method'],$params['htmlOptions']);
}

function userFormStart()
{
    $params = Tools::function_params();

    if (!isset($params['action']))
        $params['action'] = '';

    if (!isset($params['method']))
        $params['method'] = 'post';

    if (!isset($params['htmlOptions']))
        $params['htmlOptions'] = array();

    global $DATA;
    return  CHtml::beginForm($params['action'],$params['method'],$params['htmlOptions']);
}

function userLoginFormStart()
{
    $params = Tools::function_params();

    global $DATA;
    return  CHtml::beginForm($params['action'],$params['method'],$params['htmlOptions']);
}

function userFormCaptcha(){
    return Yii::app()->controller->widget('CCaptcha',array(),true);
}

function userFormLabel()
{
    $params = Tools::function_params();
    global $DATA;

    $profileFields = array();
    if (isset($DATA['profileFields']))
        $profileFields = $DATA['profileFields'];

    if (in_array($params['name'],array_keys($profileFields)))
    {
        $model = $DATA['profile'];
    }else{
        $model = $DATA['model'];
    }

    return CHtml::activeLabelEx($model,$params['name'],$params['htmlOptions']);
}

function userFormTextField()
{
    $params = Tools::function_params('name');
    global $DATA;

    $profileFields = $DATA['profileFields'];

    if (in_array($params['name'],array_keys($profileFields)))
    {
        $model = $DATA['profile'];
    }else{
        $model = $DATA['model'];
    }
    return CHtml::activeTextField($model,$params['name'],$params['htmlOptions']);
}

function userFormPasswordField()
{
    $params = Tools::function_params();

    global $DATA;
    return CHtml::activePasswordField($DATA['model'],$params['name'],$params['htmlOptions']);
}

function userFormCheckBox($name){
    global $DATA;
    return CHtml::activeCheckBox($DATA['model'],$name);
}

function userFormErrors()
{
    $params = Tools::function_params();
    global $DATA;

    return  CHtml::errorSummary($DATA['model'],$params['header'],$params['footer'],$params['htmlOptions']);
}

function userFormError()
{
    $params = Tools::function_params();
    global $DATA;

    $errors  = $DATA['model']->getErrors();
    $name    = $params['name'];
    $content = $params['content'];

    $error =  isset($errors[$name]) ? $errors[$name][0] : '';

    if ($error)
        return str_replace('{error}',$error,$content);

    return '';
}

function userFormSubmit(){

    $params = Tools::function_params();

    $text = UserModule::t(isset($params['text']) ? $params['text'] : 'Login');

    return CHtml::submitButton($text,$params['htmlOptions']);
}

function userInfo(){

    global $DATA;
    $params = Tools::function_params();

    if ($params['name'] == 'status')
       return CHtml::encode(User::itemAlias("UserStatus",$DATA['user']->status));

    $profileFields = $DATA['profileFields'];

    if (in_array($params['name'],array_keys($profileFields)))
    {
        $field   = $profileFields[$params['name']];
        $profile = $DATA['user']->profile;

        return (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname))));
    }

    return CHtml::encode($DATA['user']->{$params['name']});
}

function userInfoLabel(){
    global $DATA;
    $params = Tools::function_params();

    $profileFields = $DATA['profileFields'];

    if (in_array($params['name'],array_keys($profileFields)))
    {
        CHtml::encode(UserModule::t($profileFields[$params['name']]->title));
    }

    return CHtml::encode($DATA['user']->getAttributeLabel($params['name']));
}