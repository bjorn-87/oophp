<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>
<div class="contentIndex">

<article>
    <?php if ($error) : ?>
        <h3>### <?= $error ?> ###</h3>
    <?php endif; ?>
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= $content->data ?>
</article>
<p class="backButtons">
    <a href="<?= url("content/blog")?>">Tillbaka</a>
</p>
</div>
