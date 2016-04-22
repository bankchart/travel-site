$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    $('form').on('submit', function(){
        var submitPerform = false;
        if($('#email').val() != '' && $('#password').val() != ''){
            submitPerform = true;
        }
        return submitPerform;
    });
});
