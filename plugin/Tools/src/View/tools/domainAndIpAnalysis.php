<p>Returns information about a given domain or IP address.</p>
<form method="post">
  <div class="form-group">
    <label for="target">Target</label>
    <input id="target" name="target" type="text" class="form-control">
  </div>
  <input type="submit" class="btn btn-default">
</form>
<?php

extract($this->vars);

if(!empty($error)){
    echo $error['msg'];
}


if(!empty($data)): ?>
	<h2>Host Details</h2>
	<pre><code>Host Address: <?php echo (!empty($data['gethostbyaddr'])?$data['gethostbyaddr']:'N/A') . "\n"; ?>
Host Name: <?php echo $data['gethostbyname'] . "\n"; ?>
Host Name List: 
<?php for($i=0; $i<count($data['gethostbynamel']); $i++): ?>
<?php echo $data['gethostbynamel'][$i]; echo $i < count($data['gethostbynamel'])?"\n":''; ?>
<?php endfor; ?></code></pre>

	<h2>Traceroute output</h2>
	<pre><code><?php echo $data['traceRoute']; ?></code></pre>

	<h2>Whois Record</h2>
	<pre><code><?php echo $data['whois']; ?></code></pre>
    
<?php endif; ?>