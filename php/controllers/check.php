<?php 
namespace controller\check;

use db\UserQuery;
use lib\Msg;
use model\UserModel;

function get($user) {

    
    \view\check\index($user);

}

function post() {

    $user = new UserModel;
    $user->user_id = get_param('user_id', '');
    $user->pwd = get_param('pwd', '');
    $user->nickname = get_param('nickname', '');

    UserModel::setSession($user);

    if(!$user) {
        Msg::push(Msg::INFO, 'もう一度登録しなおしてください。');
    }
    $success = UserQuery::insert($user);

    if(!$success) {
        Msg::push(Msg::ERROR, 'エラーが発生しました。');
        get_url('register');
    } else {

        UserModel::setSession(UserQuery::fetchById($user->user_id));

        Msg::push(Msg::INFO, '登録が完了しました。');
        redirect(GO_HOME);
    }

    
}
