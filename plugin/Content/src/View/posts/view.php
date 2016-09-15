<?php
/**
 * view.php.
 */
extract($this->vars);

echo '<article>'
."<h1>{$post['title']}</h1>"
."<section>{$post['body']}</section>"
.'</article>';

echo '<nav aria-label="more"><ul class="pager">';

if (!empty($prev['slug'])) {
    echo "<li class=\"previous\"><a href=\"/content/posts/view/{$prev['slug']}\"><i class=\"fa fa-caret-left\" aria-hidden=\"true\"></i> Prev</a></li>";
}

if (!empty($next['slug'])) {
    echo "<li class=\"next\"><a href=\"/content/posts/view/{$next['slug']}\">Next <i class=\"fa fa-caret-right\" aria-hidden=\"true\"></i></a></li>";
}

echo '</ul></nav>';

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
<hr>
<aside class="ad">

    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Leaderboard -->
    <!--
    <ins class="adsbygoogle"
         style="display:inline-block;width:728px;height:90px"
         data-ad-client="ca-pub-2297949586762275"
         data-ad-slot="3778634944"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script> -->

    <!-- Responsive -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-2297949586762275"
         data-ad-slot="2167680542"
         data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

</aside>
<hr>
<aside class="clearfix">
    <a name="comments"></a>
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'jasondsnider'; // required: replace example with your forum shortname
        var disqus_identifier = '<?php echo $post['slug']; ?>';
        var disqus_url = 'https://jasonsnider.com/<?php echo $_SERVER['REQUEST_URI']; ?>';

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>
        Please enable JavaScript to view the
        <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a>
    </noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
</aside>
