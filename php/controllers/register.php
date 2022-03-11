<?php

namespace controller\register;

use lib\Auth;
use lib\Msg;
use model\UserModel;

function get()
{
    require_once SOURCE_BASE . 'views/register.php';
}

function post()
{
    $user = new UserModel;
    $user->user_id = get_param('user_id', '');
    $user->pwd = get_param('pwd', '');
    $user->nickname = get_param('nickname', '');


    if (Auth::check($user)) {

        require_once SOURCE_BASE . 'controllers/check.php';

        \controller\check\get($user);

    } else {

        redirect(GO_REFERER);
        
    }
}
