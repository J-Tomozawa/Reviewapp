<?php 
namespace controller\topic\detail;

use db\DataSource;
use lib\Msg;
use db\TopicQuery;
use lib\Auth;
use model\TopicModel;
use model\UserModel;
use Throwable;

function get() {

    $topic = new TopicModel;
    $topic->topic_name = get_param('topic_id', '', false);
    
    $fetchedTopic = TopicQuery::fetchByName($topic);


    if(empty($fetchedTopic)) {
        
        $fetchedTopic = null;
    }

    \view\topic\detail\index($fetchedTopic);
   
}

function post()
{

    Auth::requireLogin();

    $topic = new TopicModel;
    $topic->topic_name = get_param('topic_name', null);
    $topic->body = get_param('body', null);

    $user = UserModel::getSession();
    $topic->user_id = $user->id;

    try {

        $db = new DataSource;

        $db->begin();

        $is_success = true;

        if ($is_success) {
            $is_success = TopicQuery::insertTopic($topic);
        }
    } catch (Throwable $e) {

        Msg::push(Msg::DEBUG, $e->getMessage());
        $is_success = false;

    } finally {

        if ($is_success) {

            $db->commit();
            Msg::push(Msg::INFO, 'コメントの登録に成功しました。');

        } else {

            $db->rollback();
            Msg::push(Msg::ERROR, 'コメントの登録に失敗しました。');

        }

    }

    redirect('topic/detail?topic_id=' . $topic->topic_name);
    
}