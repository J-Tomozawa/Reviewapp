<?php

namespace view\topic\detail;

use lib\Auth;

function index($topics = null)
{
    $topics = escape($topics);
    $detail_content = detailContent($_GET['topic_id']);
    
?>
    <div class="topic">
        <div class="topic__wrap">
            <ul class="topic__groups">
                <?php if(!$detail_content): ?>
                    <li class="topic__group"><h2><?php echo $_GET['topic_id']; ?></h2></li>
                    <?php else: ?>
                <li class="topic__group">
                    <div class="topic__left">
                        <img id="topic__img" src="<?php echo $detail_content[1]['largeImageUrl']; ?>" alt="画像はありません">
                    </div>
                    <div class="topic__right pb-15">
                        <table>
                            <tr>
                                <th>タイトル</th>
                                <td><?php echo $detail_content[1]['title']; ?></td>
                            </tr>
                            <tr>
                                <th>作者</th>
                                <td><?php echo $detail_content[1]['author'] ?></td>
                            </tr>
                            <tr>
                                <th>出版社</th>
                                <td><?php echo $detail_content[1]['publisherName'] ?></td>
                            </tr>
                            <tr>
                                <th>リンク</th>
                                <td>
                                    <form action="<?php echo $detail_content[1]['affiliateUrl'] ?>" method="get">
                                    <button class="afiliate" type="submit">楽天</button>
                                    </form>
                                </td>
                            </tr>
                        </table>
                    </div>
                </li>
                <?php endif; ?>
                <li class="topic__group">
                    <?php if(Auth::isLogin()): ?>
                    <form action="<?php echo CURRENT_URI; ?>" method="POST">
                        <div class="add-top">
                            <input type="hidden" name="topic_name" value="<?php echo $_GET['topic_id']; ?>">
                            <textarea class="add-textarea" name="body" cols="30" rows="10"></textarea>
                        </div>
                        <div class="add-button-wrap">
                            <button class="add-button" type="submit">追加する</button>
                        </div>
                    </form>
                    <?php else: ?>
                        <h3 class="center">ログインしてコメントを追加しよう！</h3>
                        <?php endif; ?>
                </li>
            </ul>
            <?php if($topics === null): ?>
                <div>
                    <h2 class="center">コメントを追加しよう！！</h2>
                </div>
                <?php else: ?>
                    <div class="comment">
                        <ul class="comment__groups">
                            <?php foreach($topics as $topic): ?>
                            <li class="comment__group">
                                <div class="comment__wrap">
                                    <span><?php echo $topic->nickname; ?></span>
                                    <div class="comment__main">
                                        <?php echo $topic->body; ?>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
        </div>
    </div>
<?php
}
