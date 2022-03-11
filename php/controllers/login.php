<?php 
namespace controller\login;

use lib\Auth;
use lib\Msg;
use model\UserModel;

function get() {
    require_once SOURCE_BASE . 'views/login.php';
}

function post() {
    $user_id = get_param('user_id', '');
    $pwd = get_param('pwd', '');

    if(Auth::login($user_id, $pwd)) {

        $user = UserModel::getSession();
        Msg::push(Msg::INFO, "{$user->nickname}さん、ようこそ。");
        redirect(GO_HOME);

    } else {

        redirect(GO_REFERER);

    }
}