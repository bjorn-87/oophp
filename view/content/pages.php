<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
?>

<?php
if (!$resultset) {
    return;
}
?>

<div class="contentIndex">

<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= esc($row->id) ?></td>
        <td><a href="<?= url("content/pages/page")?>/<?= esc($row->path) ?>"><?= esc($row->title) ?></a></td>
        <td><?= esc($row->type) ?></td>
        <td><?= esc($row->status) ?></td>
        <td><?= esc($row->published) ?></td>
        <td><?= esc($row->deleted) ?></td>
    </tr>
<?php endforeach; ?>
</table>

</div>
