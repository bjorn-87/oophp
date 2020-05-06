<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>
<div class="movieIndex">
    <h2>Admin</h2>
<form class="movieForm" method="post">
    <fieldset>
    <legend>Välj film</legend>

    <p>
        <label>Film:<br>
        <select name="movieId">
            <option value="">Välj film...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= htmlentities($movie->title) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
    </fieldset>
</form>
</div>
