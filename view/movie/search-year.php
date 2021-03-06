<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<div class="movieSearch">
    <h2>Sök på år</h2>
<form class="movieForm" method="get">
    <fieldset>
    <legend>Search</legend>
    <!-- <input type="hidden" name="route" value="search-year"> -->
    <p>
        <label>Created between:
        <input type="number" name="year1" value="<?= $year1 ?: 1900 ?>" min="1900" max="2100"/>
        -
        <input type="number" name="year2" value="<?= $year2  ?: 2100 ?>" min="1900" max="2100"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
    <p class="backButtons"><a href="show-all">Visa alla</a></p>
    </fieldset>
</form>
</div>
