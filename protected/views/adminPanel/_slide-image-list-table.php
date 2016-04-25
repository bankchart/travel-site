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
                            <td><?=$no++?></td>
                            <td><?=$record->slider_name?></td>
                            <td><?=$record->create_datetime?></td>
                            <td><?=$record->author->fullname?></td>
                            <td>
                                <span id='<?=$record->slider_id?>'
                                    class='label label-primary manage-label'>manage</span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
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
                        <i id='record-info'>
                            Showing <?=($offset + 1)?> to
                            <?=count($model)<$limit?count($model):$limit?> of
                            <?=count(SliderModel::model()->findAll())?> entries
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
