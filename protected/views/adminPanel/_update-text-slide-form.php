<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Text Slider
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=Yii::app()->baseUrl;?>/adminPanel/Slide-Image-List"><i class="fa fa-dashboard"></i> Text over slide</a></li>
            <li class="active">Update text slide</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class='box box-primary'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Update text slider form</h3>
            </div>
            <div class='box-body'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-6 col-sm-8 col-xs-12'>
                                <form role='form'>
                                    <div class="form-group">
                                        <label>Slider name</label>
                                        <input type='text' class='form-control' id='slider-name'
                                            name='slider-name'/>
                                    </div>
                                    <label>Image list :</label>
                                    <fieldset style='border: 1px solid #D2D6DE; border-radius: 3px; padding: 15px;'>
                                        <div class="form-group">
                                            <label>Image name</label>
                                            <input type='text' name='image-name' placeholder='Enter image name' class='form-control'/>
                                        </div>
                                        <div class="form-group">
                                            <label>Detail over image</label>
                                            <img alt='image of slider' class='form-control' src=''/>
                                            <textarea class='form-control' placeholder='Enter content over image'></textarea>
                                        </div>
                                    </fieldset>
                                    <br/>
                                    <button type='button' class='pull-right btn btn-primary'>Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section><!-- /.content -->
</div>
