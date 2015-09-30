<?php
/**
 * Provides a view for Jsc.ToolController::random_configuration_strings_for_cakephp();
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
  The follow fields provide psuedo-random strings that are sutible for the cipher and salt values in CakePHP's
  core.php file.
</p>

<form method="post">
  <strong>Salt</strong>
  <pre>
    <?php echo htmlentities($this->vars['salt']); ?>
  </pre>

  <strong>Cipher</strong>
  <pre>
    <?php echo $this->vars['cipher']; ?>
  </pre>
  <input type="submit" value="New Hashes" class="btn btn-default"></div>
</form>