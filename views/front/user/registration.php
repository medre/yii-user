{{layout header}}

        <div class="timer-area">
<h1><?php echo UserModule::t("Registration"); ?></h1>

<div class="form">

    {{userregisterFormStart class="deneme" enctype="multipart/form-data"}}

    {{userformErrors}}

   	<div class="row">
        {{userformLabel name="username"}} : {{userformTextField name="username"}}
        {{userformError name="username" content="<span class='test'>{error}</span>"}}
	</div>

    <div class="row">
        {{userformLabel name="password"}} : {{userformPasswordField name="password"}}
	</div>

     <div class="row">
        {{userformLabel name="verifyPassword"}} : {{userformPasswordField name="verifyPassword"}}
	 </div>

    <div class="row">
        {{userformLabel name="email"}} : {{userformTextField name="email"}}
	</div>

     <div class="row">
        {{userformLabel name="firstname"}} : {{userformTextField name="firstname"}}
	 </div>

     <div class="row">
        {{userformLabel name="lastname"}} : {{userformTextField name="lastname"}}
	 </div>

     <div class="row">
        {{userformLabel name="lastname"}} : {{userformTextField name="lastname"}}
	 </div>

    {{userformCaptcha}}

    {{userformTextField name="verifyCode"}}

    <div class="row submit">
		{{userformSubmit text="Kayıt"}}
	</div>

    {{formEnd}}
</div><!-- form -->

</div>
{{layout footer}}