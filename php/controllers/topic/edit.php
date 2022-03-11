<?php

namespace controller\topic\edit;

use db\TopicQuery;
use lib\Msg;
use lib\Auth;
use model\TopicModel;
use model\UserModel;
use Throwable;

function get()
{
    Auth::requireLogin();

    $topic = TopicModel::getSessionAndFlush();

    if (!empty($topic)) {
        Msg::push(Msg::ERROR, 'コメントがありません。');
        redirect('404');
    }

    $topic = new TopicModel;
    $topic->topic_id = get_param('topic_id', null, false);

    $user = UserModel::getSession();
    Auth::requirePermission($topic->topic_id, $user);

    $fetchedTopic = TopicQuery::UserTopics($topic, $user);

    \view\topic\edit\index($fetchedTopic);
}

function post()
{

    Auth::requireLogin();

    $topic = new TopicModel;
    $topic->id = get_param('topic_id', null, false);
    $topic->topic_name = get_param('topic_name', null);
    $topic->body = get_param('body', null);

    $delete = get_param('delete', null);

    if ($delete) {
        try {
            $is_success = TopicQuery::delete($topic);
        } catch (Throwable $e) {
            Msg::push(Msg::DEBUG, $e->getMessage());
            $is_success = false;
        }
        if ($is_success) {
            Msg::push(Msg::INFO, 'トピックの削除に成功しました。');
            redirect('topic/archive');
        } else {

            Msg::push(Msg::ERROR, 'トピックの削除に失敗しました。');
            TopicModel::setSession($topic);
            redirect(GO_REFERER);
        }
    } else {


        $user = UserModel::getSession();
        Auth::requirePermission($topic->id, $user);


        try {

            $is_success = TopicQuery::update($topic);
        } catch (Throwable $e) {

            Msg::push(Msg::DEBUG, $e->getMessage());
            $is_success = false;
        }

        if ($is_success) {

            Msg::push(Msg::INFO, 'トピックの更新に成功しました。');
            redirect('topic/archive');
        } else {

            Msg::push(Msg::ERROR, 'トピックの更新に失敗しました。');
            TopicModel::setSession($topic);
            redirect(GO_REFERER);
        }
    }
}
