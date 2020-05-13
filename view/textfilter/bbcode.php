<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<div class="movieIndex">


<h1>Showing off BBCode</h1>

<h2>Source in bbcode.txt</h2>
<pre><?= wordwrap($text) ?></pre>

<h2>Filter BBCode applied, source</h2>
<pre><?= wordwrap($htmlBbcode) ?></pre>

<h2>Filter BBCode applied, HTML (including nl2br())</h2>
<?= $bbcodeNl2br ?>

</div>
