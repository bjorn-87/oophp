<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<navbar class="navbarMovie">
    <a href="movie/show-all">Visa alla</a>
    <a href="movie/show-all-paginate">visa alla (paginate)</a>
    <a href="movie/search-title">Sök på titel</a>
    <a href="movie/search-year">Sök på år</a>
    <a href="movie/reset">Återställ</a>
    <a href="movie/movie-select">Admin</a> 
       <!-- <a href="?route=movie-edit">Edit</a> | -->
    <!-- <a href="show-all-sort">Show all sortable</a> | -->
</navbar>

<div class="movieIndex">
    <h1>Filmdatabas</h1>
    <p>Välkommen till min filmdatabas.</p>
    <p>Här kan du söka på titlar</p>
</div>
