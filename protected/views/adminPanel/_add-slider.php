<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Slider
            <small>Upload images</small>
        </h1>
        <ol class="breadcrumb">
            <li class='active'><i class="fa fa-dashboard"></i> Add slider</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class='row'>
            <div class='col-md-6 col-sm-6'>
                <div class='box box-default'>
                    <div class='box-header with-border'>
                        <h3 class='box-title'>Set up slide</h3>
                    </div>
                    <div class='box-body'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <form id='slider-form' name='slider-form' enctype='multipart/form-data'
                                    method='post' class='form-horizontal' action='#'>
                                    <div class='form-group'>
                                        <label for='slider-name' class='col-md-3 col-sm-3 control-label'>
                                            Slider name
                                        </label>
                                        <div class='col-md-9 col-sm-9'>
                                            <input class='form-control' type='text' name='slider-name'
                                                placeholder='Enter slider name' id='slider-name' required/>
                                        </div>
                                    </div>
                                    <div class='form-group'>
                                        <label class='col-md-3 col-sm-3 control-label'>
                                            Images
                                        </label>
                                        <div class='col-md-9 col-sm-9'>
                                            <input style='width: 100%; margin-top: 7px;' type='file' multiple='multiple'
                                                name='slider-images[]' id='slider-images' required/>
                                            <p class="help-block">multiple selection<br/>
                                                extension support <b>pjpeg</b> / <b>jpeg</b> / <b>png</b> / <b>gif</b> and less than <b>20Mb</b>)</p>
                                            <div class='preview-images'></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-offset-3 col-sm-offset-3
                                            col-md-9 col-sm-9">
                                            <button disabled='disabled' id='submit-upload-btn' type='button' class="btn btn-default">Upload to server</button>
                                        </div>
                                    </div>
                                    <input type="hidden" id='confirm-submit' name="confirm-submit" value='non-submit'>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class='col-md-6 col-sm-6'>
                <div class='box box-default'>
                    <div class='box-header with-border'>
                        <h3 class='box-title'>Images preview</h3>
                    </div>
                    <div class='box-body'>
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class='progress progress-xxs active' style='margin-bottom: 0px;'>
                                    <div id='progress-upload-images' class='progress-bar pull-left progress-bar-success
                                        progress-bar-striped' role='progressbar'
                                        aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: 0%;'>
                                    </div>
                                </div>
                                <div class="thumbnail text-center">
                                    <small>status image(s) uploading.</small>
                                    <!--div>
                                        <img src='<?=Yii::app()->baseUrl;?>/images/test/holiday-3.jpg' />
                                        <div><i class='fa fa-close'></i></div>
                                    </div-->
                                    <!--  -->
                                    <div class='img-preview'></div>
                                    <!---->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div>
