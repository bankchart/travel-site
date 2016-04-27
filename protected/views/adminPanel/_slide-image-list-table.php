<div class="alert-over-page alert-hide">
    <p>
        <label>&nbsp;</label>
        <small style='display: block;'>
            <i>click for hide.</i>
        </small>
    </p>

</div>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Text Slider
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Text over slide</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='box box-default'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Slider list on table</h3>
            </div>
            <div class='box-body'>
                <div class="row" style='padding-bottom: 10px;'>
                    <div class="col-sm-12">
                        <i>Show records&nbsp;
                            <select name="show-records" id="show-records">
                                <option value="5">5</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </i>
                        <i class='pull-right'>
                            Search&nbsp;
                            <input id='slider-search' type='text'
                                placeholder='Slider name'/>
                        </i>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" class='checkbox-all'></th>
                            <th>No.</th>
                            <th><?=$attributeLabels['slider_name']?></th>
                            <th><?=$attributeLabels['create_datetime']?></th>
                            <th>Author</th>
                            <th>Management</th>
                        </tr>
                    </thead>
                    <tbody id='slider-content'>
                        <?php
                        $no=$offset + 1;
                        foreach($model as $record):
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name='sliders' value='<?=$record->slider_id?>'
                                    class='checkbox-slider'
                                    id="<?=$record->slider_id?>"/>
                            </td>
                            <td><?=$no++?></td>
                            <td><?=$record->slider_name?></td>
                            <td><?=$record->create_datetime?></td>
                            <td><?=$record->author->fullname?></td>
                            <td>
                                <span title='redirect to manage slider form page' id='<?=$record->slider_id?>'
                                    class='label label-primary manage-label'>manage</span>
                                <span title='remove this slider now' id='<?=$record->slider_id?>'
                                    class='label label-danger remove-label'>
                                    remove
                                </span>
                            </td>
                        </tr>
                        <?php
                        endforeach;
                        if(count($model) == 0)
                            echo '<tr><td colspan="6" class="text-center">Slider empty.</td></tr>';
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" class='checkbox-all'></th>
                            <th>No.</th>
                            <th><?=$attributeLabels['slider_name']?></th>
                            <th><?=$attributeLabels['create_datetime']?></th>
                            <th>Author</th>
                            <th>Management</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row" style='padding-top: 10px;'>
                    <div class="col-sm-12">
                        <i class='help-block' style='display: inline;'>selected with&nbsp;:&nbsp;</i>
                        <span id='multi-remove' title='multi-remove' class="label label-danger remove-label">remove</span>
                    </div>
                </div>
                <div class="row" style='padding-top: 10px;'>
                    <div class="col-sm-12">
                        <i id='record-info'>
                        <?php if(count($model) > 0): ?>
                            Showing <?=($offset + 1)?> to
                            <?=count($model)<$limit?count($model):$limit?> of
                            <?=count(SliderModel::model()->findAll())?> entries
                        <?php else: ?>
                            Slider empty.
                        <?php endif; ?>
                        </i>
                        <i class='pull-right'>
                            Page&nbsp;
                            <select name="show-page" id="show-page">
                                <?=$selectPage?>
                            </select>
                        </i>
                    </div>
                </div>
            </div>
            <!-- end: .box-body -->
        </div>
        <!-- end: .box .box-default -->
    </section><!-- /.content -->
</div>
