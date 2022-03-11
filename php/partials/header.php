<?php

namespace partials;

use lib\Auth;
use lib\Msg;



function header()
{
?>

  <!DOCTYPE html>
  <html lang="ja">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Review App</title>
    <link rel="stylesheet" href="<?php echo BASE_CSS_PATH; ?>nomalize.css" />
    <link rel="stylesheet" href="<?php echo BASE_CSS_PATH; ?>style.css" />
  </head>

  <body>
    <header>
      <div id="container" class="container">
        <div class="header-menu-icon">
          <div class="mobile-menu__cover"></div>
          <div class="header-left">
            <a href="<?php echo get_url(GO_HOME); ?>"><img src="<?php echo BASE_IMAGE_PATH; ?>header-logo.png" /></a>
          </div>
          <?php if (Auth::isLogin()) : ?>
            <div class="header-right">
              <button class="mobile-menu__btn">
                <span></span>
                <span></span>
                <span></span>
              </button>
              <nav class="mobile-menu nav-islogin">
                <ul class="mobile-menu__main">
                  <li class="mobile-menu__item islogin">
                    <a class="mobile-menu__link" href="<?php echo get_url('logout'); ?>">ログアウト</a>
                  </li>
                  <li class="mobile-menu__item islogin">
                    <a class="mobile-menu__link" href="<?php echo get_url('/topic/archive'); ?>">マイページ</a>
                  </li>
                </ul>
              </nav>
            </div>
          <?php else : ?>
            <div class="header-right">
              <button class="mobile-menu__btn mr-20">
                <span></span>
                <span></span>
                <span></span>
              </button>
              <nav class="mobile-menu">
                <ul class="mobile-menu__main">
                  <li class="mobile-menu__item">
                    <a class="mobile-menu__link" href="<?php echo get_url('register'); ?>">
                      新規登録
                    </a>
                  </li>
                  <li class="mobile-menu__item">
                    <a class="mobile-menu__link" href="<?php echo get_url('login'); ?>">
                      ログイン
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </header>
    <main>
    <?php
  Msg::flush();  
}
