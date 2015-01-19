{{layout header}}

<div class="timer-area">

    <div class="form">
        {{userFormStart}}

            <div class="row">
                {{userFormlabel name="login_or_email"}}
                {{userFormTextField name="login_or_email"}}

                <p class="hint"><?php echo UserModule::t("Please enter your login or email addres."); ?></p>
            </div>

            <div class="row submit">
                 {{userformSubmit text="Gönder"}}
            </div>

        {{formEnd}}
    </div><!-- form -->

</div>
{{layout footer}}