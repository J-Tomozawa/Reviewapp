<?php

namespace view\topic\edit;

function index($topic)
{
$topic = escape($topic);
?>
       <div class="opinion">
            <div class="opinion__wrap">
                <form class="opinion__groups" method="POST">
                    <div class="opinion__group">
                        <div class="opinion__left">
                            <h2 class="mr-50"><?php echo $topic[0]->topic_name; ?></h2>
                            <input type="hidden" name="topic_name" value="<?php echo $topic[0]->topic_name; ?>">
                            <form action="<?php echo get_url('topic/archive'); ?>" method="POST">
                            <input type="hidden" name="delete" value="delete">
                            <button class="return delete" type="submit">削除</button>
                            </form>
                        </div>
                        <div class="opinion__right pb-15">
                            <textarea class="textarea" name="body"><?php echo $topic[0]->body; ?></textarea>
                            <div class="edit">
                                <div>
                                    <a class="return" href="<?php echo get_url('topic/archive'); ?>" class="edit__return">戻る</a>
                                </div>
                                <div class="add-button-wrap">
                                    <button type="submit" class="edit__btn add-button">編集する</button>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

<?php
}
