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

<nav class="contentNavbar">
    <a href="<?= url("content/create")?>">Create</a>
    <a href="<?= url("content/reset")?>">Reset</a>
</nav>
<div class="contentIndex">

<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
        <th>Actions</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= esc($row->id) ?></td>
        <td><?= esc($row->title) ?></td>
        <td><?= esc($row->type) ?></td>
        <td><?= esc($row->published) ?></td>
        <td><?= esc($row->created) ?></td>
        <td><?= esc($row->updated) ?></td>
        <td><?= esc($row->deleted) ?></td>
        <td>
            <a class="icons" href="<?= url("content/edit")?>?id=<?= esc($row->id) ?>" title="Edit this content">
                <i class="fas fa-edit fa-2x" aria-hidden="true"></i>
            </a>
            <a class="icons" href="<?= url("content/delete")?>?id=<?= esc($row->id) ?>" title="Delete this content">
                <i class="fas fa-trash fa-2x" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>

</div>
