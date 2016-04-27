<?php
$no = $offset + 1;
foreach($model as $record):
?>
<tr>
    <td>
        <input type='checkbox' name='sliders' value='<?=$record->slider_id?>'
            class='checkbox-slider'
            id='<?=$record->slider_id?>' />
    </td>
    <td><?=$no++?></td>
    <td><?=$record->slider_name?></td>
    <td><?=$record->create_datetime?></td>
    <td><?=$record->author->fullname?></td>
    <td>
        <span title='redirect to manage slider form page' id='<?=$record->slider_id?>'
            class='label label-primary manage-label'>manage</span>
        <span title='remove this slider now' id='<?=$record->slider_id?>' class='label label-danger remove-label'>
            remove
        </span>
    </td>
</tr>
<?php endforeach; ?>
