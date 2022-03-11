<?php

namespace view\topic\archive;

function index($topics)
{
    $topics = escape($topics);
?>
    <h1 class="center">過去にしたコメント</h1>
    <ul>
        <?php
        foreach ($topics as $topic) {
            $url = get_url('topic/edit?topic_id=' . $topic->id);
            \partials\topic_list_item($topic, $url);
        }
        ?>
    </ul>
    <?php
}
