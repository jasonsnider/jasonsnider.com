<?php
/**
 * Provides a view for Jsc.ToolController::password_genrator();
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
<p>A simple utility for generating high entropy psuedo-random passwords.</p>

<h2>Design Your Password</h2>

<form method="Post" class="form-inline">
  
  <div class="form-group">
    <label for="Size">Length</label>
    <input class="form-control" id="Size" name="length" type="text" size=3 value="<?php echo $this->vars['length']; ?>">
  </div>

  <div class="form-group">
    <label for="Upper">Uppercase</label>
    <input id="Upper" name="upper" type="checkbox" <?php echo $this->vars['upper']; ?>>
  </div>
  
  <div class="form-group">
    <label for="Lower">Lowercase</label>
    <input id="Lower" name="lower" type="checkbox" <?php echo $this->vars['lower']; ?>>
  </div>
  
  <div class="form-group">
    <label for="Numeric">Numeric</label>
    <input id="Numeric" name="numeric" type="checkbox" <?php echo $this->vars['numeric']; ?>>
  </div>
  
  <div class="form-group">
    <label for="Special">Special</label>
    <input id="Special" name="special" type="checkbox" <?php echo $this->vars['special']; ?>>
  </div>
  
  <div class="form-group">
    <input type="submit" class="btn btn-default">
  </div>

</form>
<br>
<pre><?php echo htmlentities($this->vars['password']); ?></pre>