$(function(){
    $('body').on('click', '.manage-label', function(){
        location.href='Update-Text-Slider-Form/' + this.id;
    });

    $('.alert-over-page p').on('click', function(){
        $('.alert-over-page p').addClass('alert-over-page-hide');
        $('.alert-over-page').removeClass('alert-show');
        $('.alert-over-page').addClass('alert-hide');
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

    $('body').on('click', '.checkbox-slider', function(){
        if(!$(this).prop('checked')){
            $('.checkbox-all').prop('checked', false);
        }else{
            var checkbox_total = 0;
            var checked_total = 0;
            $('.checkbox-slider').each(function(){
                if($(this).prop('checked'))
                    checked_total++;
                checkbox_total++;
            });
            if(checked_total == checkbox_total &&
                checked_total > 0 && checkbox_total > 0)
                $('.checkbox-all').prop('checked', true);
        }
    });

    $('body').on('click', '.remove-label', function(){
        if(confirm('confirm remove this slider')){
            if(this.id != 'multi-remove')
                removeSlider(this.id);
            else{
                removeSlider(JSON.stringify($('.checkbox-slider').serialize()));
            }
        }
    });

    function removeSlider(id){
        $.ajax({
            url: 'Remove-Slider',
            type: 'post',
            data: {slider_id : id},
            success: function(data){
                $('.alert-over-page').removeClass('alert-hide').addClass('alert-show');

                if(data == 'deleted'){
                    $('.alert-over-page p label').text('Delete completed.');
                    sliderListPartial($('#slider-content'));
                }else
                    $('.alert-over-page p label').text('Delete failed.');

                $('.alert-over-page p').removeClass('alert-over-page-hide');
            },
            error: function(responseText){
                console.log('in error removeSlider Fn.');
            },
            complete: function(){}
        });
    }

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
                loading += '<td colspan="6" style="text-align: center">';
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
                        elm_update.html('<tr><td colspan="6" style="text-align: center">Slider empty.</td></tr>');
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
