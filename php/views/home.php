<div class="topic">
  <div class="topic__wrap">
    <form class="topic__search" action="<?php echo get_url('search'); ?>">
      <input class="topic__search-box" name="search_box" type="text" placeholder="キーワードを入力" />
      <input class="topic__search-btn" type="submit" value="検索" />
    </form>
    <ul class="topic__groups">
      <?php
      $arry = home();
      for ($i = 1; $i <= count($arry); $i++) :

        $title_url = get_url('topic/detail?topic_id=' . $arry[$i]['title']);

      ?>
        <li class="topic__group">
          <div class="topic__left">
            <a href="<?php echo $title_url; ?>">
              <img id="topic__img" src="<?php echo $arry[$i]['largeImageUrl']; ?>" alt="画像はありません">
            </a>
          </div>
          <div class="topic__right pb-15">
            <table>
              <tr>
                <th>タイトル</th>
                <td><?php echo $arry[$i]['title']; ?></td>
              </tr>
              <tr>
                <th>作者</th>
                <td><?php echo $arry[$i]['author']; ?></td>
              </tr>
              <tr>
                <th>出版社</th>
                <td><?php echo $arry[$i]['publisherName']; ?></td>
              </tr>
              <tr>
                <th>リンク</th>
                <td>
                  <form action="<?php echo $arry[$i]['affiliateUrl']; ?>" method="GET">
                    <button class="afiliate" type="submit">楽天</button>
                  </form>
                </td>
              </tr>
            </table>
          </div>
        </li>
      <?php endfor; ?>

    </ul>
  </div>
</div>
<?php
