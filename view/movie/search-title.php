<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<div class="movieSearch">
    <h2>Sök på titel</h2>
<form class="movieForm" method="get">
    <fieldset>
    <legend>Search</legend>
    <!-- <input type="hidden" name="route" value="search-title"> -->
    <p>
        <label>Title:<br>
            <input type="search" name="searchTitle" placeholder="use % as wildcard" value="<?= htmlentities($searchTitle) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
    </fieldset>
</form>
</div>
