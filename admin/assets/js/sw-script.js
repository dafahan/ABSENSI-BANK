$(document).ready(function() {
function loading(){
    $(".loading").show();
    $(".loading").delay(1500).fadeOut(500);
}

/* ----------- LOGIN ------------*/
$('#form-login').submit(function (e) {
    e.preventDefault();
    if($('#email').val()=='' && $('#password').val()==''){    
         swal({title:'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
        return false;
        loading();
    }
    else{
        loading();
        $.ajax({
            url:"./sw-proses?action=login",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function () { 
              loading();
            },
            success: function (data) {
                if (data == 'success') {
                    swal({title: 'Berhasil!', text: 'Selamat datang.!', icon: 'success', timer: 1500,});
                   setTimeout(function(){ location.reload(); }, 1500);
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 1500,});
                }

            },
            complete: function () {
                $(".loading").hide();
            },
        });
    }
});


/* ---------- ADD ABSENSI -----------------*/
var arg = {
        resultFunction: function(result) {
            var redirect = './sw-proses?action=add-absen';
            $.redirectPost(redirect, {id: result.code});
        }
    };
    
    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");
    decoder.play();
    $('select').on('change', function(){
        decoder.stop().play();
    });

    // jquery extend function
    $.extend(
    {
        redirectPost: function(location, args)
        {
            var form = '';
            $.each( args, function( key, value ) {
                form += '<input type="hidden" name="'+key+'" value="'+value+'">';
            });
            $('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
        }
    });
/*
var arg = {
        resultFunction: function(result) {
            var id = 1;
            $.ajax({
            url:"./sw-proses?action=absen",
            type: "POST",
            data:{id:id},
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function () { 
              //loading();
            },
            success: function (data) {
                if (data == 'success') {
                    swal({title: 'Berhasil!', text: 'Selamat datang.!', icon: 'success', timer: 1500,});
                   setTimeout(function(){ location.reload(); }, 1500);
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 1500,});
                }

            },
            complete: function () {
                $(".loading").hide();
            }
        });
        }
    };
    
    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");
    decoder.play();
    /*  Without visible select menu
        decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
    */


});

/* ---------- Forgot ---------------*/
$(document).ready(function () {
    $('#sw_forgot').submit(function (e) {
        e.preventDefault();
        //$('#btnSave').text('Submit...'); //change button text
        //$('#btnSave').attr('disabled',true); //set button disable 
        $('#barloading').show();
        $.ajax({
            url: "./act-forgot",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
                if (data == 'ok') {
                    $("#success").fadeIn(2000);
                    $("#failed").hide();
                    $("#sw_forgot")[0].reset();
                    $('#barloading').hide(1000);
                    $(".messages").html('Katasandi baru berhasil disetel ulang, silahkan cek email masuk/spam..!').show();
                    //window.location.href = window.location.href;
                } else {
                    $(".messages").html(data).show();
                    $("#failed").fadeIn(2000);
                    $("#success").hide();
                    $('#barloading').hide(1000);
                }
            }
        });
    });
});

/* ---------- Pengumuman ---------------*/
$(document).ready(function () {
    $('#sw_pengumuman').submit(function (e) {
        e.preventDefault();
        $('#barloading').show();
        $.ajax({
            url: "./act-pengumuman",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            success: function (data) {
                $("#success").fadeIn(2000);
                $("#failed").hide();
                $('#barloading').hide(1000);
                $(".messages").html(data).show(); 
            }
        });
    });
});