<?php
$no = $offset + 1;
foreach($model as $record):
?>
<tr>
    <td><?=$no++?></td>
    <td><?=$record->slider_name?></td>
    <td><?=$record->create_datetime?></td>
    <td><?=$record->author->fullname?></td>
    <td>
        <span id='<?=$record->slider_id?>'
            class='label label-primary manage-label'>manage</span>
        <span id='<?=$record->slider_id?>' class='label label-danger remove-label'>
            remove
        </span>
    </td>
</tr>
<?php endforeach; ?>
