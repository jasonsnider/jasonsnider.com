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

?>
<hr>
<aside itemscope itemtype="http://data-vocabulary.org/Person">
    <div class="media">
        <div class="media-left">
            <a href="#">
                <img alt="64x64" class="media-object thumbnail" src="https://secure.gravatar.com/avatar/57dd069b73a149098c4865f8f5813303.png" height="80px" width="80px" style="margin-bottom: 0;">
            </a>
        </div>
        <div class="media-body">
            <h4 class="media-heading">About the Author</h4>
            Hi, I'm
            <a href="https://plus.google.com/+JasonSnider?rel=author" target="_blank" itemprop="name">Jason Snider</a>
            a <span itemprop="title">full stack web developer, designer, systems architect</span>, security enthusiast,
            Linux aficionado, open source advocate, sys admin, DBA, business analyst, project manager and scrum master.
        </div>
    </div>
</aside>
