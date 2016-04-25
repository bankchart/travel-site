$(function(){
    $('.manage-label').on('click', function(){
        location.href='Update-Text-Slider-Form/' + this.id;
    });

    $('#show-records').on('change', function(){
        $('#show-page').val(1);
        sliderListPartial($('#slider-content'));
    });

    $('body').on('change', '#show-page', function(){
        sliderListPartial($('#slider-content'));
    });

    $('#slider-search').on('keyup', function(){
        $('#show-records').val(5);
        $('#show-page').val(1);
        sliderListPartial($('#slider-content'));
    });

    function sliderListPartial(elm_update){
        $.ajax({
            url: 'slideimagelisttableajax',
            data: {
                'show-records' : $('#show-records').val(),
                'show-page' : $('#show-page').val(),
                'slider-search' : $('#slider-search').val()
            },
            type: 'post',
            dataType: 'json',
            beforeSend: function(){
            //    console.log('show-records : ' + $('#show-records').val());
            //    console.log('show-page : ' + $('#show-page').val());
            },
            success: function(data){
            //    console.log('response === >>>' + data.slider_content_partial);
                elm_update.html(data.slider_content_partial);
                $('#show-page').html(data.selectPage);
                $('#record-info').html(data.record_info);
            },
            error: function(responseText){},
            complete: function(data){
            //    console.log(data);
                if(data.responseJSON.slider_content_partial == "")
                    elm_update.html('<tr><td colspan="5" style="text-align: center">Slider empty.</td></tr>');
            }
        });
    }
});
