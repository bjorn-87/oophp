<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<div class="movieIndex">

<h1>Återställ databasen</h1>

<form class="movieForm" method="post">
    <input type="submit" name="reset" value="Reset">
    <?= $output ?>
</form>

</div>
