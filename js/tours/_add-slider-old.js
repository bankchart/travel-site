$(function(){
    var textRes = 'uploaded';
    var chk = false;
    $('#slider-images').on('keyup', function(){
        $('#slider-images').change();
    });
    $('#slider-images').on('change', function(){
        if($(this).val() === ''){
            $('#progress-upload-images').width(0);
            $('.thumbnail .img-preview').html('');
            $('.thumbnail small').html('status image(s) uploading.');
            return false;
        }
        $('#progress-upload-images').width(0);
        $('.thumbnail small').html('<div><img width="18" src="../images/loading.gif"/></div>');
        var wait = setTimeout(function(){
            if($('#progress-upload-images').width() == 0){
                setTimeout(function(){
                    $('#slider-form').submit();
                }, 1000);
            }else{
                setTimeout(wait, 2000);
            }
        }, 2000);
    });
    $('#slider-form').on('submit', function(e){
        if($('#slider-name').val().trim() !== '' && $('#slider-images').val() !== ''){
            imagesPreviewAjax(this)
            slideSubmit(this);
        }else{
            $('#slider-name').focus();
            $('.thumbnail small').html('<div class="alert alert-danger">Enter your slider name please.</div>');
        }return false;
    });
    // function replaceSpace(text){
    //     var temp = '';
    //     if(text.indexOf(' ') != '-1'){
    //         text[text.indexOf(' ')] = '-';
    //         replaceSpace(text);
    //     }
    //     return text;
    // }
    $('#submit-upload').on('click', function(){
        if($('#slider-name').val().trim() !== '' && $('#slider-images').val() !== ''){
            $.ajax({
                url: 'addslider',
                data: {
                            'slider-name' : $('#slider-name').val().trim()
                        },
                type: 'post',
                success: function(data){
                    console.log('addslider return data: ' + data);
                },
                error: function(responseText){
                    console.log('submit-addslider-error' + responseText);
                }
            });
        }
    });
    function slideSubmit(e){
        $.ajax({
            url: 'addslider',
            data: new FormData(e),
            type: 'post',
            processData: false,
            contentType: false,
            async: false,
            success: function(data){
                if(data == 'success'){
                    console.log('success');
                }else
                    console.log('failed');
            },
            error: function(requestObject, error, errorThrown) {
                console.log(error);
                console.log(errorThrown);
            }
        });
    }
    function imagesPreviewAjax(e){
        var result = false;
        $.ajax({
            url: 'addsliderpreview',
            data: new FormData(e),
            type: 'post',
            dataType: 'json',
            processData: false,
            contentType: false,
            async: false,
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
                    result = true;
                }
                $('.thumbnail small').html(textRes);
                console.table(data);
                var i=0;
                var imgs = '';
                for(d of data){
                    imgs += "<img " +
                        "src='"+d+"' />";
                }
                $('.img-preview').html(imgs);
            },
            error: function(responseText){
                $('.thumbnail .img-preview').html('');
                console.log('in error');
                //console.log(responseText);
                document.getElementById('slider-form').reset();
                textRes = 'upload fail or else';
                $('.thumbnail small').html(textRes);
                $('#progress-upload-images').width(0);
            }
        });
        return result;
    }
    function progressUploading(e){
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
});
