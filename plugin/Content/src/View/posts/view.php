<?php
/**
 * view.php
 */
extract($this->vars);

echo "<article>"
. "<h1>{$post['title']}</h1>"
. "<section>{$post['body']}</sdyection>"
. "</article>";

if(!empty($prev['slug'])){
    echo "<a href=\"/content/posts/view/{$prev['slug']}\">Prev</a>";
}

if(!empty($next['slug'])){
    echo "<a href=\"/content/posts/view/{$next['slug']}\">Next</a>"; 
}