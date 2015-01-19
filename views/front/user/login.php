{{layout header}}
<div class="timer-area">
    <h1>Giriş</h1>

    <div class="form" style="text-align:left">
    {{userLoginFormStart}}

        {{userformErrors}}
        <div class="row">
            {{userformLabel name="username"}}
            {{userformTextField name="username" class="deneme"}}
        </div>

        <div class="row">
            {{userformLabel name="password"}}
            {{userformPasswordField name="password"}}
        </div>

        <div class="row">
            {{userformSubmit}}
        </div>

    {{formEnd}}
    </div><!-- form -->
</div>
{{layout footer}}