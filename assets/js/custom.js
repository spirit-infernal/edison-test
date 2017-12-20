$(document).ready(function() {
   var entry = $('.enter-mode');
     entry.on('show.bs.collapse','.collapse', function() {
       entry.find('.collapse.show').collapse('hide');
     });
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
                        var alert = $('.alert-popup');
                            alert.text(response).css({'opacity':'1', 'top':'60px'});
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                    }
            });
        return false;
    });

    // $('#regForm #submitR').on('click', function(e) {
    //     e.preventDefault();
    //     var result = $.ajax({
    //             type: 'POST',
    //             url: $('#regForm').attr('action'),
    //             data: $('#regForm').serialize(),
    //             beforeSend: function() {
    //                 console.log($('#regForm').serialize());
    //             },
    //             success: function (response, textStatus, jqXHR) {
    //                     var alert = $('.alert-popup');
    //                         alert.text(response).css({'opacity':'1', 'top':'60px'});
    //                 setTimeout(function(){
    //                     location.reload();
    //                 }, 1000);
    //             }
    //         });
    //     return false;
    // });

    $('#logout').on('click', function(e) {
        e.preventDefault();
            var result = $.ajax({
                type: 'POST',
                url: 'assets/php/exit.php',
                success: function (response, textStatus, jqXHR) {
                        var alert = $('.alert-popup');
                            alert.text(response).css({'opacity':'1', 'top':'60px'});
                    setTimeout(function(){
                        location.reload();
                    }, 1000);
                }
            });
        return false;
    });
});