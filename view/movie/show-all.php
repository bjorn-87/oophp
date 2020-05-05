<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$resultset) {
    return;
}
?>
<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= htmlentities($row->id) ?></td>
        <td><img class="thumb" src="../image/movie/<?= htmlentities($row->image) ?>?w=200&a=4,27,11,0&cf&sharpen"></td>
        <td><?= htmlentities($row->title) ?></td>
        <td><?= htmlentities($row->year) ?></td>
    </tr>
<?php endforeach; ?>
</table>
