<?php
/**
 * Provides a view for Jsc.ToolController::php_hases();
 * 
 * Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 * Licensed under The MIT License
 * 
 * @copyright Copyright 2013, Jason D Snider. (http://jasonsnider.com)
 * @link http://jasonsnider.com
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * 
 * @author Jason D Snider <jason@jasonsnider.com>
 * @package jasonsnider.com
 */

?>
<p>
  Uses hash() and hash_algos() to return a given string hashed using every 
  algorithm supported by (this servers version of) PHP's hash() function.
</p>

<pre><code><?php 
echo htmlentities('<?php');
echo "\n";
echo htmlentities('$string = "123abc";');
echo "\n";
echo htmlentities('foreach(hash_algos() as $hash):'); 
echo "\n";
echo "  ";
echo htmlentities('echo "<div><strong>{$hash}</strong>";');
echo "\n";
echo "  ";
echo htmlentities('echo \'<pre>\' . hash($hash, $string) . \'</pre></div>\';');
echo "\n";
echo htmlentities('endforeach;');
echo "\n";
echo htmlentities('?>');
?></code></pre>

<?php $string = $this->vars['string']; ?>
<?php if ($string !== false): ?>
    <hr>
    <div>
      <strong>Below you'll find the hashed values for the string:</strong>
      <pre><?php echo htmlentities($string); ?></pre>
    </div>
    <?php foreach (hash_algos() as $hash): ?>
        <strong><?php echo $hash; ?></strong>
        <pre><?php echo hash($hash, $string); ?></pre>
    <?php endforeach; ?>  
<?php endif; ?>
<hr>

<form method="post">
  <div class="form-group">
    <label for="Hash">Enter a string to get it's hash values</label>
    <textarea class="form-control" id="Hash" name="string_to_hash"></textarea>
  </div>
  <div class="submit"><input type="Submit" class="btn btn-default"></div>
</form>