<?php
 $data = array(
     array(
         'title'=>'Your IP Address',
         'value'=>$_SERVER['REMOTE_ADDR']
     ),
     array(
         'title'=>'Host Details (Your ISP)',
         'value'=>gethostbyaddr($_SERVER['REMOTE_ADDR'])
     ),
     array(
         'title'=>'Browser Details',
         'value'=>$_SERVER['HTTP_USER_AGENT']
     ),
     array(
         'title'=>'Referer (How you got here)',
         'value'=>isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'N/A'
     ),
 );
?>

<p>
	Welcome to Jason Snider's "who am I?" page. This is a utility for viewing some the of the data and meta data ISPs 
	and site operators can see, store and track when you visit their web sites and use there services. This is a break
	down of how they see you. If your using a tool privacy tool such a <a href="https://www.torproject.org/">TOR</a> 
	you can use this to benchmark your profile. Later, return to this page using your privacy tools and see how your
	profile has changed. For more privacy tools visit <a href="https://pack.resetthenet.org/">Reset The Net's Privacy 
	Pack</a>.
</p>

<?php for($i=0; $i<count($data); $i++): ?>

	<?php echo $data[$i]['title']; ?>
	<div class="answer"><?php echo $data[$i]['value']; ?></div>
	
<?php endfor; ?>

<aside class="ad">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- Leaderboard -->
	<ins class="adsbygoogle"
		 style="display:inline-block;width:728px;height:90px"
		 data-ad-client="ca-pub-2297949586762275"
		 data-ad-slot="3778634944"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</aside>