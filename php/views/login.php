

    <h1 class="login-title">ログイン</h1>
    <div class="login">
        <div class="login__form">
            <form action="<?php echo CURRENT_URI; ?>" method="POST" novalidate autocomplete="off">
                <div class="login__group pt-50 pr-50 pl-50 pb-25">
                    <label for="user_id">ユーザーID</label>
                    <input id="user_id" width="20" type="text" name="user_id"minlength="4" required maxlength="10" pattern="[a-zA-Z0-9]+" autofocus />
                    <div class="feedback"></div>
                </div>
                <div class="login__group pt-25 pr-50 pl-50 pb-25">
                    <label for="pwd">パスワード</label>
                    <input id="pwd" width="20" type="password" name="pwd" minlength="4" required tabindex="2" pattern="[a-zA-Z0-9]+" class="form-control validate-target" />
                    <div class="feedback"></div>
                </div>
                <div class="form-btn">
                    <div class="register">
                        <a href="<?php echo get_url('register'); ?>">アカウント登録</a>
                    </div>
                    <div class="submit">
                        <input type="submit" value="ログイン">
                    </div>
                </div>
            </form>
        </div>
    </div>
