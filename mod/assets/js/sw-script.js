$(document).ready(function() {
function loading(){
    $(".loading").show();
    $(".loading").delay(2000).fadeOut(600);
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
                    //setTimeout(function(){location.reload(); }, 1500);
                     setTimeout("location.href = './';",2000);
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


/* ----------- REGISTRASI ------------*/
$('#form-registrasi').submit(function (e) {
    e.preventDefault();
    if($('#email').val()=='' && $('#password').val()=='' && $('#position_id').val()=='' && $('#shift_id').val()=='' && $('#building').val()==''){    
         swal({title:'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
        return false;
        loading();
    }
    else{
        loading();
        $.ajax({
            url:"./sw-proses?action=registrasi",
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
                    swal({title: 'Berhasil!', text: 'Selamat Anda berhasil Daftar!', icon: 'success', timer: 1500,});
                    //setTimeout(function(){ location.reload(); }, 1500);
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


/* ----------- FORGOT ------------*/
$('#form-forgot').submit(function (e) {
    e.preventDefault();
    if($('#email').val()==''){    
         swal({title:'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
        return false;
        loading();
    }
    else{
        loading();
        $.ajax({
            url:"./sw-proses?action=forgot",
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
                    swal({title: 'Berhasil!', text: 'Password baru berhasil disetel ulang, silahkan cek email masuk/spam!', icon: 'success', timer: 2000,});
                    //setTimeout(function(){ location.reload(); }, 1500);
                    setTimeout("location.href = './';",3000);
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


/* ---------- UPDATE PROFILE -----------------*/
$('#update-profile').submit(function (e) {
    e.preventDefault();
    if($('#name').val()==''){    
         swal({title:'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
        return false;
        loading();
    }
    else{
        loading();
        $.ajax({
            url:"./sw-proses?action=profile",
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
                    swal({title: 'Berhasil!', text: 'Profil berhasil di perbaharui!', icon: 'success', timer: 2000,});
                    setTimeout(function(){ location.reload(); }, 2500);
                    $(".btn-profile").text('Simpan');
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 2000,});
                    $(".btn-profile").text('Simpan');
                }

            },
            complete: function () {
                $(".loading").hide();
            },
        });
    }
});



/* ---------- UPDATE PASSWORD-----------------*/
$('#update-password').submit(function (e) {
    e.preventDefault();
    if($('#employees_password').val()==''){    
         swal({title:'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
        return false;
        loading();
    }
    else{
        loading();
        $.ajax({
            url:"./sw-proses?action=update-password",
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
                    swal({title: 'Berhasil!', text: 'Password berhasil di perbaharui!', icon: 'success', timer: 2000,});
                    setTimeout(function(){ location.reload(); }, 2500);
                    
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 2000,});
                   
                }
            },

            complete: function () {
                 $(".loading").hide();
            },
        });
    }
});

/* --------- UPDATE PHOTO PROFILE ---------------*/
 $(document).on('change','#avatar',function(){
        var file_data = $('#avatar').prop('files')[0];  
        var image_name = file_data.name;
        var image_extension = image_name.split('.').pop().toLowerCase();

        if(jQuery.inArray(image_extension,['gif','jpg','jpeg','png']) == -1){
          swal({title: 'Oops!', text: 'File yang di unggah tidak sesuai dengan format, File harus jpg, jpeg, gif, png.!', icon: 'error', timer: 2000,});
        }

        var form_data = new FormData();
        form_data.append("file",file_data);
        $.ajax({
          url:'./sw-proses?action=update-photo',
          method:'POST',
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          beforeSend:function(){
            loading();
          },
          success:function(data){
                if (data == 'success') {
                    swal({title: 'Behasil!', text:'Photo Profil berhasil diperbaharui.!', icon: 'success', timer: 1500,});
                    setTimeout(function(){location.reload(); }, 1600);
                } else {
                    swal({title: 'Oops!', text: data, icon: 'error', timer: 2000,});
                }
          }
        });
});

/* --------- LOAD DATA HISTORY ---------------*/
loadData();
function loadData() {
    $.ajax({
        url: './sw-proses?action=history',
        type: 'POST',
        success: function(data) {
          $('.loaddata').html(data);
        }
    });
}

$('.btn-clear').click(function (e) {
    loadData();
    $('.start_date').val();
    $('.start_date').val();
});

$('.btn-sortir').click(function (e) {
        var from = $('.start_date').val();
        var to   = $('.end_date').val();

       $.ajax({
          url:"./sw-proses?action=history",
          method:"POST",
          data:{from:from,to:to},
          dataType:"text",
          cache: false,
          async: false,
            beforeSend: function () { 
             loading();
            },
            success: function (data) {
                $('.loaddata').html(data);
            },
        complete: function () {
            $(".loading").hide();
        },
    });
});

$('.btn-print').click(function (e) {
        var from        = $('.start_date').val();
        var to          = $('.end_date').val();
        var type        = $('.type').val();
        if(type =='pdf'){
            // cek berdasarkan bulan
            if(from==''){    
                var url = "./print?action=pdf";
            }else{
                var url = "./print?action=pdf&from="+from+"&to="+to+"";
            }
        }else{
            if(from==''){    
                var url = "./print?action=excel";
            }else{
                var url = "./print?action=excel&from="+from+"&to="+to+"";
            }
        }
        window.open(url, '_blank');
});

/* ------------------- UPDATE DATA HISTORY ------------------------- */
    $(document).on('click', '.modal-update', function(){
        $('#modal-show').modal('show');
        var presence_id = $(this).attr("data-id"); 
        document.getElementById('presence_id').value = presence_id;

        /*var masuk = $(this).attr("data-masuk"); 
        document.getElementById('timein').value = masuk;

        var pulang = $(this).attr("data-pulang"); 
        document.getElementById('timeout').value = pulang;*/

        var status = $(this).attr("data-status"); 
        document.getElementById('status').value = status;

        var information = $(this).attr("data-information"); 
        document.getElementById('information').value = information;

        var tanggal = $(this).attr("data-date"); 
        $('.status-date').html(tanggal);
    });

    /* ---------- UPDATE HISTORY-----------------*/
        $('#update-history').submit(function (e) {
            e.preventDefault();
            if($('#timein').val()=='' && $('#timeout').val()==''){    
                 swal({title:'Oops!', text: 'Harap bwidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
                return false;
                loading();
            }
            else{
                loading();
                $.ajax({
                    url:"./sw-proses?action=update-history",
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
                            swal({title: 'Berhasil!', text: 'Absensi berhasil di perbaharui!', icon: 'success', timer: 2000,});
                            //setTimeout(function(){ location.reload(); }, 2500);
                            $('#modal-show').modal('hide');
                            loadData();
                        } else {
                            swal({title: 'Oops!', text: data, icon: 'error', timer: 2000,});
                            
                        }
                    },

                    complete: function () {
                         $(".loading").hide();
                         $('#modal-show').modal('hide');
                    },
                });
            }
        });

});


jQuery(function($) {
  setInterval(function() {
    var date = new Date(),
        time = date.toLocaleTimeString();
    $(".clock").html(time);
  }, 1000);
});


/* ---------- Print -----------------*/
function nWin(context,title) {
    var printWindow = window.open('', '');
    var doc = printWindow.document;
    doc.write("<html><head>");
    doc.write("<title>"+title+" - Print Mode</title>");    
    doc.write("<link href='mod/assets/css/sw-print.css' rel='stylesheet' type='text/css' media='print'>");
    doc.write("</head><body>");
    doc.write(context);
    doc.write("</body></html>");
    doc.close();
    function show() {
        if (doc.readyState === "complete") {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        } else {
            setTimeout(show, 100);
        }
    };
    show();
};

$(function() {
    $(".print").click(function(){nWin($("#divToPrint").html(),$("#pagename").html());});
});

function printData(){
   var divToPrint=document.getElementById("printArea");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

/*$('.btn-print').on('click',function(){
    printData();
})*/