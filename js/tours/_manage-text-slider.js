$(function(){
    $('body').on('click', '.manage-label', function(){
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

    $('.checkbox-all').on('click', function(){
        $('.checkbox-slider').prop('checked', $(this).prop('checked'));
        $('.checkbox-all').prop('checked', $(this).prop('checked'));
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
                var loading = '<tr>';
                loading += '<td colspan="5" style="text-align: center">';
                loading += '<img width="20" src="../images/loading.gif"/>';
                loading += '</td>';
                loading += '</tr>';
                elm_update.html(loading);
            },
            success: function(data){
                setTimeout(function(){
                    if(data.slider_content_partial != ''){
                        elm_update.html(data.slider_content_partial);
                    }else{
                        elm_update.html('<tr><td colspan="5" style="text-align: center">Slider empty.</td></tr>');
                    }
                }, 500);
                $('#show-page').html(data.selectPage);
                $('#record-info').html(data.record_info);
            },
            error: function(responseText){},
            complete: function(data){
                // if(data.responseJSON.slider_content_partial == "")
                //     elm_update.html('<tr><td colspan="5" style="text-align: center">Slider empty.</td></tr>');
            }
        });
    }
});
