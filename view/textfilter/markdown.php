<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1>Showing off Markdown</h1>

<h2>Markdown source in sample.md</h2>
<pre class="preWrap"><?= $text ?></pre>

<h2>Text formatted as HTML source</h2>
<pre class="preWrap"><?= $htmlMarkdown ?></pre>

<h2>Text displayed as HTML</h2>
<?= $markDown ?>
