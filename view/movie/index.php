<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<navbar class="navbar">
    <a href="movie/show-all">Show all movies</a> |
    <a href="movie/reset">Reset database</a> |
    <a href="movie/search-title">Search title</a> |
    <a href="movie/search-year">Search year</a> |
    <a href="movie/movie-select">Select</a> |
       <!-- <a href="?route=movie-edit">Edit</a> | -->
    <!-- <a href="show-all-sort">Show all sortable</a> | -->
    <!-- <a href="?route=show-all-paginate">Show all paginate</a> | -->
</navbar>
