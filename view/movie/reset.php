<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<form method="post">
    <input type="submit" name="reset" value="Reset database">
    <?= $output ?>
</form>
