<?php

require_once 'config.php';

// model
require_once SOURCE_BASE . 'models/abstract.model.php';
require_once SOURCE_BASE . 'models/user.model.php';
require_once SOURCE_BASE . 'models/topic.model.php';
require_once SOURCE_BASE . 'models/api.model.php';

// db 
require_once SOURCE_BASE . 'db/datasource.php';
require_once SOURCE_BASE . 'db/user.query.php';
require_once SOURCE_BASE . 'db/topic.query.php';

// lib
require_once SOURCE_BASE . 'libs/auth.php';
require_once SOURCE_BASE . 'libs/helper.php';
require_once SOURCE_BASE . 'libs/message.php';
require_once SOURCE_BASE . 'libs/router.php';

// Partials
require_once SOURCE_BASE . 'partials/header.php';
require_once SOURCE_BASE . 'partials/footer.php';
require_once SOURCE_BASE . 'partials/topic-list-item.php';

// View
require_once SOURCE_BASE . 'views/check.php';
require_once SOURCE_BASE . 'views/topic/archive.php';
require_once SOURCE_BASE . 'views/topic/detail.php';
require_once SOURCE_BASE . 'views/topic/edit.php';



session_start();

\partials\header();

$url = parse_url(CURRENT_URI);

$rpath = str_replace(BASE_CONTEXT_PATH, '', $url['path']);

$method = strtolower($_SERVER['REQUEST_METHOD']);

route($rpath, $method);

function route($rpath, $method) {
    if($rpath === '') {
        $rpath = 'home';
    }
    
    $targetFile = SOURCE_BASE . "controllers/{$rpath}.php";
    
    if(!file_exists($targetFile)) {
        require_once SOURCE_BASE . "views/404.php";
        return;
    }

    require_once $targetFile;
    
    $rpath = str_replace('/', '\\', $rpath);

    $fn = "\\controller\\{$rpath}\\{$method}";

    $fn();
}

\partials\footer();
