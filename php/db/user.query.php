<?php 
namespace db;

use db\DataSource;
use model\UserModel;

class UserQuery {
    public static function fetchById($user_id) {

        $db = new DataSource;
        $sql = 'select * from users where user_id = :user_id;';

        $result = $db->selectOne($sql, [
            ':user_id' => $user_id
        ], DataSource::CLS, UserModel::class);

        return $result;

    }

    public static function insert($user) {

        $db = new DataSource;
        $sql = 'insert into users(user_id, pwd, nickname) values (:user_id, :pwd, :nickname);';

        $user->pwd = password_hash($user->pwd, PASSWORD_DEFAULT);

        return $db->execute($sql, [
            ':user_id' => $user->user_id,
            ':pwd' => $user->pwd,
            ':nickname' => $user->nickname,
        ]);

    }
}