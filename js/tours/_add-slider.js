$(function(){
    var textRes = 'uploaded';
    $('#slider-images').on('change', function(){
        if($(this).val() === ''){
            $('#progress-upload-images').width(0);
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
        imagesPreviewAjax(this)
        e.preventDefault();
    });
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
                    $('.thumbnail small').html(textRes);
                    $('#progress-upload-images').width(0);
                    return;
                }else{
                    textRes = 'uploaded.';
                }
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
                console.log('in error');
                console.log(responseText);
                document.getElementById('slider-form').reset();
                textRes = 'upload fail or else';
                $('.thumbnail small').html(textRes);
                $('#progress-upload-images').width(0);
                return;
            }
        });
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
