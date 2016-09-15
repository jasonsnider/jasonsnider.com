<?php
/**
 * view.php
 */
extract($this->vars);

echo "<article>"
. "<h1>{$post['title']}</h1>"
. "<section>{$post['body']}</section>"
. "</article>";

echo "<nav aria-label=\"more\"><ul class=\"pager\">";

if(!empty($prev['slug'])){
    echo "<li class=\"previous\"><a href=\"/content/posts/view/{$prev['slug']}\"><i class=\"fa fa-caret-left\" aria-hidden=\"true\"></i> Prev</a></li>";
}

if(!empty($next['slug'])){
    echo "<li class=\"next\"><a href=\"/content/posts/view/{$next['slug']}\">Next <i class=\"fa fa-caret-right\" aria-hidden=\"true\"></i></a></li>";
}

echo "</ul></nav>";
