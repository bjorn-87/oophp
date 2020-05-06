<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>
<div class="movieIndex">
    <h2>Lägg till/uppdatera information</h2>
<form class="movieForm" method="post">
    <fieldset>
    <legend>Edit</legend>
    <!-- <?= var_dump($movie) ?> -->
    <input type="hidden" name="movieId" value="<?= htmlentities($movie->id) ?>"/>

    <p>
        <label>Title:<br>
        <input type="text" name="movieTitle" value="<?= htmlentities($movie->title) ?>"/>
        </label>
    </p>

    <p>
        <label>Year:<br>
        <input type="number" name="movieYear" min="1" required value="<?= htmlentities($movie->year) ?>"/>
    </p>

    <p>
        <label>Image:<br>
        <input type="text" name="movieImage" value="<?= htmlentities($movie->image) ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Save">
        <input type="reset" value="Reset">
    </p>
    <p class="backButtons">
        <a href="movie-select">Tillbaka</a> | <a href="show-all">Visa alla</a>
    </p>
    </fieldset>
</form>
</div>
