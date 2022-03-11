<?php

namespace partials;

function topic_list_item($topic, $title_url)
{
?>
        <div class="opinion">
            <div class="opinion__wrap">
                <ul class="opinion__groups">
                    <li class="opinion__group">
                        <div class="opinion__left">
                            <h2><a href="<?php echo $title_url; ?>"><?php echo $topic->topic_name; ?></a></h2>
                        </div>
                        <div class="opinion__right pb-15">
                            <p><?php echo $topic->body; ?></p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


<?php
}
