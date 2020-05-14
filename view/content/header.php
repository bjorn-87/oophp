<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<navbar class="movieNavbar">
    <a href="<?= url("content/show-all")?>">Show all content</a>
    <a href="<?= url("content/pages")?>">View pages</a>
    <a href="<?= url("content/blog")?>">View blog</a>
    <a href="<?= url("content/admin")?>">Admin</a>
</navbar>
