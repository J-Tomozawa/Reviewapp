<?php

namespace db;

use db\DataSource;
use model\TopicModel;

class TopicQuery
{
    public static function fetchByUserId($user)
    {

        if (!$user->isValidId()) {
            return false;
        }

        $db = new DataSource;
        $sql = 'select * from comments where user_id = :user_id and del_flg != 1 order by id desc;';

        $result = $db->select($sql, [
            ':user_id' => $user->id
        ], DataSource::CLS, TopicModel::class);

        return $result;
    }


    public static function fetchByTopicId($topic)
    {

        if (!$topic->isValidId()) {
            return false;
        }

        $db = new DataSource;
        $sql = '
        select 
            c.*, u.nickname 
        from comments c
        inner join users u 
            on c.user_id = u.id 
        where c.del_flg != 1
            and u.del_flg != 1
        order by c.id desc
        ';

        $result = $db->select($sql, [], DataSource::CLS, TopicModel::class);

        return $result;
    }

    public static function UserTopics($topic, $user)
    {

        $db = new DataSource;
        $sql = 'select c.*, u.nickname from comments c  inner join users u on c.user_id = u.id where c.id = :topic_id and u.id = :user_id and c.del_flg != 1 and u.del_flg != 1;';


        $result = $db->select($sql, [
            ':topic_id' => $topic->topic_id,
            ':user_id' => $user->id
        ], DataSource::CLS, TopicModel::class);

        return $result;
    }

    public static function fetchByName($topic)
    {

        if (!$topic->isValidId()) {
            return false;
        }

        $db = new DataSource;
        $sql = 'select c.*, u.nickname from comments c  inner join users u on c.user_id = u.id where c.topic_name = :topic_name and c.del_flg != 1 and u.del_flg != 1;';

        $result = $db->select($sql, [
            ':topic_name' => $topic->topic_name
        ], DataSource::CLS, TopicModel::class);

        return $result;
    }
    public static function insertTopic($topic) {

        $db = new DataSource;
        $sql = 'insert into comments(topic_name, body, user_id) values (:topic_name, :body, :user_id)';

        // $user->pwd = password_hash($user->pwd, PASSWORD_DEFAULT);

        return $db->execute($sql, [
            ':topic_name' => $topic->topic_name,
            ':body' => $topic->body,
            ':user_id' => $topic->user_id,
        ]);

    }

    public static function update($topic)
    {

        if (!$topic->isValidId()) {
            return false;
        }

        $db = new DataSource;
        $sql = 'update comments set topic_name = :topic_name, body = :body where id = :id';

        return $db->execute($sql, [
            ':body' => $topic->body,
            ':topic_name' => $topic->topic_name,
            ':id' => $topic->id,
        ]);
    }

    public static function isUserOwnTopic($topic_id, $user)
    {

        if (!(TopicModel::validateId($topic_id) && $user->isValidId())) {
            return false;
        }

        $db = new DataSource;
        $sql = 'select count(1) from comments c where c.id = :topic_id and c.user_id = :user_id and c.del_flg != 1;';

        $result = $db->selectOne($sql, [
            ':topic_id' => $topic_id,
            ':user_id' => $user->id,
        ]);

        return $result;
    }

    public static function delete($topic)
    {

        if (!$topic->isValidId()) {
            return false;
        }

        $db = new DataSource;
        $sql = 'delete from comments where id = :id';

        return $db->execute($sql, [
            ':id' => $topic->id,
        ]);
    }
    
}
