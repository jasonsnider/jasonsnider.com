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
<p>Returns some basic information (meta data) about a given string.</p>
<?php if (isset($View->vars['character_count'])): ?>
    <table class="tabular">
      <tbody>
        <tr>
          <th>Character Count</th>
          <td><?php echo $View->vars['character_count']; ?></td>
        </tr>
        <tr>
          <th>Is Numeric</th>
          <td><?php echo $View->vars['is_numeric']; ?></td>
        </tr>
      </tbody>
    </table>
<?php endif; ?>



<form method="post">

  <div class="form-group">
    <label for="String"></label>
    <textarea id="String" name="string" class="form-control"></textarea>
  </div>

  <input type="submit" class="btn btn-default">

</form>
