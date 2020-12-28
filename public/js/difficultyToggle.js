
$(document).ready(function(){
    $("#gender_radio a, #like_radio a").on('click', function(){
        var selected = $(this).data('title');
        var toggle = $(this).data('toggle');
        $('#'+toggle).prop('value', selected);
        $('a[data-toggle="'+toggle+'"]').not('[data-title="'+selected+'"]').removeClass('active').addClass('noActive');
        $('a[data-toggle="'+toggle+'"][data-title="'+selected+'"]').removeClass('noActive').addClass('active');
    })
});
