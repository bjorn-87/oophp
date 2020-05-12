<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<div class="movieNavbar">
    <a href="<?= url("textfilter/bbcode") ?>">Bbcode</a>
    <a href="<?= url("textfilter/clickable") ?>">Clickable</a>
    <a href="<?= url("textfilter/markdown") ?>">Markdown</a>
</div>
<br>
<br>
<br>
