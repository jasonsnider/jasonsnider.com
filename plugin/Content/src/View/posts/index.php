<?php
/**
 * index.php
 */

extract($this->vars);

foreach($posts as $post):
    echo "<div>"
    . "<h2><a href=\"/content/posts/view/{$post['slug']}\">{$post['title']}</a></h2>"
    ."<div class=\"text-muted\"><small><em>Posted on: {$post['created']}</em></small></div>"
    . substr(strip_tags($post['body']),0,420)
    . (strlen(substr(strip_tags($post['body']),0,420))>400?'...':null)
    . "</div>";
endforeach;
