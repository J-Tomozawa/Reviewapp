<?php
namespace view\check;

function index($user) {
    $user = escape($user);

?>
    <h1 class="login-title pt-50">入力確認</h1>
    <div class="login">
        <div class="login__form">
            <form action="<?php echo get_url('check'); ?>" method="POST" novalidate autocomplete="off">
                <div class="login__check-group pt-50 pr-50 pl-50 pb-25">
                    <h4 >ユーザーID</h4>
                    <input type="text" name="user_id" value="<?php echo $user->user_id; ?>" readonly>
                </div>
                <div class="login__check-group pt-25 pr-50 pl-50 pb-25">
                    <h4>パスワード</h4>
                    <input type="password" name="pwd" value="<?php echo $user->pwd; ?>" readonly>
                </div>
                <div class="login__check-group pt-25 pr-50 pl-50 pb-25">
                    <h4>ニックネーム</h4>
                    <input type="text" name="nickname" value="<?php echo $user->nickname; ?>" readonly>
                </div>
                <div class="form-btn">
                    <div class="submit">
                        <a class="return" href="<?php echo get_url('register'); ?>">戻る</a>
                    </div>
                    <div class="submit">
                        <input type="submit" value="登録する">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
}