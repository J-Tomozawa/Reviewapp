
<div class="topic">
  <div class="topic__wrap">
    <form class="topic__search" action="<?php echo get_url('search'); ?>">
      <input class="topic__search-box" name="search_box" type="text" placeholder="タイトルを検索" />
      <input class="topic__search-btn" type="submit" value="検索" />
    </form>
    <ul class="topic__groups">
      <?php
      $title = get_param('search_box', null, false);
      $array = detailContent($title);
      if(!$array) :
        ?>
        <h2>検索結果はありませんでした。</h2>
        <?php
        else :
      for ($i = 1; $i <= count($array); $i++) :

        $title_url = get_url('topic/detail?topic_id=' . $array[$i]['title']);

      ?>
        <li class="topic__group">
          <div class="topic__left">
            <a href="<?php echo $title_url; ?>">
              <img id="topic__img" src="<?php echo $array[$i]['largeImageUrl']; ?>" alt="画像はありません">
            </a>
          </div>
          <div class="topic__right pb-15">
            <table>
              <tr>
                <th>タイトル</th>
                <td><?php echo $array[$i]['title']; ?></td>
              </tr>
              <tr>
                <th>作者</th>
                <td><?php echo $array[$i]['author']; ?></td>
              </tr>
              <tr>
                <th>出版社</th>
                <td><?php echo $array[$i]['publisherName']; ?></td>
              </tr>
              <tr>
                <th>リンク</th>
                <td>
                  <form action="<?php echo $array[$i]['affiliateUrl']; ?>" method="GET">
                    <button class="afiliate" type="submit">楽天</button>
                  </form>
                </td>
              </tr>
            </table>
          </div>
        </li>
      <?php endfor; 
            endif;
      ?>

    </ul>
  </div>
</div>
<?php
