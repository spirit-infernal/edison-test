$(document).ready(function() {
   var entry = $('.enter-mode');
     entry.on('show.bs.collapse','.collapse', function() {
       entry.find('.collapse.show').collapse('hide');
     });

    // $('#logForm #passwordField').on('blur', function(){
    //     $('#logForm #submitE').attr('disabled', '');
    // });
    $('#logForm #submitE').on('click', function(e) {
        e.preventDefault();
            var result = $.ajax({
                type: 'POST',
                url: $('#logForm').attr('action'),
                data: $('#logForm').serialize(),
                beforeSend: function() {
                    // $('#submitE').attr('disabled', 'disabled');
                },
                success: function (response, textStatus, jqXHR) {
                    if (response === "success") {
                        // window.attr('href','/');
                    } else {
                        var alert = $('.alert-popup');
                            alert.text(response).css({'opacity':'1', 'top':'60px'});
                    }
                }
            });
        return false;
    });


    // $('#regForm #passwordFieldR2').on('blur', function(){
    //     $('#regForm #submitR').attr('disabled', '');
    // });

    $('#regForm #submitR').on('click', function(e) {
        e.preventDefault();
            var result = $.ajax({
                type: 'POST',
                url: $('#regForm').attr('action'),
                data: $('#regForm').serialize(),
                beforeSend: function() {
                    // $('#submitR').attr('disabled', 'disabled');
                },
                success: function (response, textStatus, jqXHR) {
                    if (response === "success") {
                        window.attr('href','/');
                    } else {
                        var alert = $('.alert-popup');
                            alert.text(response).css({'opacity':'1', 'top':'60px'});
                    }
                }
            });
        return false;
    });
});