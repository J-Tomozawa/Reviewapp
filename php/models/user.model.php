<?php 
namespace model;

use lib\Msg;

class UserModel extends AbstractModel {

    public int $id;
    public string $user_id;
    public string $pwd;
    public string $nickname;
    public int $del_flg;

    protected static $SESSION_NAME = '_user';

    public function isValidId() {

        return static::validateId($this->user_id);
        
    }

    public static function validateId($user_id) {
        $res = true;

        if(empty($user_id)) {

            Msg::push(Msg::ERROR, 'ユーザーIDを入力してください。');
            $res = false;

        } else {

            if(strlen($user_id) > 10) {
                Msg::push(Msg::ERROR, 'ユーザーIDは１０桁以下で入力してください。');
                $res = false;
            }

            if(!ctype_alnum($user_id)) {
                Msg::push(Msg::ERROR, 'ユーザーIDは半角英数字で入力してください。');
                $res = false;
            }

        }
        
        return $res;
    }
    
    public function isValidPwd()
    {
        return static::validatePwd($this->pwd);
    }

    public static function validatePwd($pwd)
    {
        $res = true;

        if (empty($pwd)) {

            Msg::push(Msg::ERROR, 'パスワードを入力してください。');
            $res = false;

        } else {

            if(strlen($pwd) < 4) {

                Msg::push(Msg::ERROR, 'パスワードは４桁以上で入力してください。');
                $res = false;

            } 
            
            if(!ctype_alnum($pwd)) {

                Msg::push(Msg::ERROR, 'パスワードは半角英数字で入力してください。');
                $res = false;
                
            }
        }
        
        return $res;
    }
    
    public function isValidNickname()
    {
        return static::validateNickname($this->nickname);
    }

    public static function validateNickname($nickname)
    {

        $res = true;

        if (empty($nickname)) {

            Msg::push(Msg::ERROR, 'ニックネームを入力してください。');
            $res = false;

        } else {

            if(mb_strlen($nickname) > 10) {

                Msg::push(Msg::ERROR, 'ニックネームは１０桁以下で入力してください。');
                $res = false;
                
            } 
        }

        return $res;
    }

}
