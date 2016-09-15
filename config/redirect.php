<?php
/**
 * redirect.php
 * This is inteded to provide a short term routing fix for moving jasonsnider.com
 * from CakePHP to TinkerMVC
 */
$uri = explode('/', $_SERVER['REQUEST_URI']);

if($uri[1] === 'post'){
    header("LOCATION:/content/posts/view/{$uri[2]}");
}

if($uri[1] === 'jsc'){
    header("LOCATION:/tools/tools/{$uri[3]}");
}
