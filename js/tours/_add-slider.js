$(function(){
    $('#slider-name').focus();
    $('#slider-name').on('keyup', function(){
        checkButtonSubmit();
    });
    $('#submit-upload-btn').on('click', function(){
        if($('#slider-name').val() !== '' && $('#slider-images').val() !== ''){
            $('#confirm-submit').val('submit');
            $('#slider-form').attr('action', 'addslider');
            $('#slider-form').submit();
        }else{
            $('#confirm-submit').val('non-submit');
        }
    });

    $('#slider-form').on('submit', function(e){
        e.preventDefault();
        var sliderName = $('#slider-name');
        var confirmSubmit = $('#confirm-submit');
        console.log('slider-name : ' + sliderName.val() + ', confirm-submit : ' +
                        confirmSubmit.val());
        if($('#slider-name').val() != '' && $('#confirm-submit').val() == 'submit'){
            //console.log('submitting');
            $.ajax({
                url: 'addslider',
                data: new FormData(this),
                type: 'post',
                processData: false,
                contentType: false,
                success: function(data){

                },
                error: function(responseText){
                    console.log('submitting');
                    console.log(responseText);
                }
            });
        }else{
            imagesPreviewAjax(this);
            console.log('submit for preview');
        }
    });

    $('#slider-images').on('change', function(){
        $('#progress-upload-images').width(0);
        $('.thumbnail .img-preview').html('');
        $('.thumbnail small').html('status image(s) uploading.');
        if($(this).val() !== ''){
            var loadingIcon = '<div><img width="18" src="../images/loading.gif"/></div>';
            $('.thumbnail small').html(loadingIcon);
            setTimeout(function(){
                $('#slider-form').submit();
            }, 2000);
        }else{
            checkButtonSubmit();
        }
    });
    /* start: preview your images */
    function checkButtonSubmit(){
        var button = $('#submit-upload-btn');
        if($('#slider-name').val() != '' && $('#slider-images').val() != ''){
            button.prop('disabled', false);
            if(button.hasClass('btn-default')){
                button.removeClass('btn-default');
                button.addClass('btn-primary');
            }
        }else{
            button.prop('disabled', true);
            if(button.hasClass('btn-primary')){
                button.removeClass('btn-primary');
                button.addClass('btn-default');
            }
        }
    }
    function imagesPreviewAjax(e){
        $.ajax({
            url: 'addsliderpreview',
            data: new FormData(e),
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            xhr: function() {
               var p = $.ajaxSettings.xhr();
               if(p.upload){
                   p.upload.addEventListener('progress',progressUploading, false);
               }
               return p;
            },
            success: function(data){
                if(data.result_upload !== undefined){
                    document.getElementById('slider-form').reset();
                    textRes = 'upload fail or else';

                    $('#progress-upload-images').width(0);
                    return;
                }else{
                    textRes = 'uploaded.';
                }
                $('.thumbnail small').html(textRes);
                console.table(data);
                var i=0;
                var imgs = '';
                for(d of data){
                    imgs += "<img alt='preview image for slider' " +
                        "src='"+d+"' />";
                }
                $('.img-preview').html(imgs);
                checkButtonSubmit();
            },
            error: function(responseText){
                $('.thumbnail .img-preview').html('');
                console.log(responseText);
                console.log('in error');
                //console.log(responseText);
                document.getElementById('slider-form').reset();
                textRes = 'upload fail or else';
                $('.thumbnail small').html(textRes);
                $('#progress-upload-images').width(0);
            }
        });
    }
    function progressUploading(e){
        console.log('progress');
        if(e.lengthComputable){
            var max = e.total;
            var current = e.loaded;
            var percentage = (current * 100)/max;
            var progElement = $('#progress-upload-images');
            $('.thumbnail small').html('uploading...' + percentage.toFixed(0) + '%');
            progElement.width(percentage + '%');
            if(percentage >= 100)
                setTimeout(function(){$('.thumbnail small').html(textRes);}, 1000);
        }
    }
    /* end: preview your images */
});
