// Load Setting
function loadSettingUmum(){
    $("#load").html('<div class="text-center"><div class="spinner-border" role="status"></div><p>Loading data...</p></div>');
    $("#load").load("mod/setting/form.php?action=setting");
}

function loadSettingHour(){
    $("#load").html('<div class="text-center"><div class="spinner-border" role="status"></div><p>Loading data...</p></div>');
    $("#load").load("mod/setting/form.php?action=setting-hour");
}

$(document).ready(function() {
  function loading(){
      $(".loading").show();
      $(".loading").delay(1500).fadeOut(500);
  }





loadSettingUmum();
/* -------------------- Edit ------------------- */
$("#load").on("submit", ".update-setting", function(e) {
    if($('#site_url').val()==''){    
         swal({title: 'Oops!', text: 'Harap bidang inputan tidak boleh ada yang kosong.!', icon: 'error', timer: 1500,});
         loading();
        return false;
    }
    else{
        loading();
        e.preventDefault();
        $.ajax({
            url:"mod/setting/proses.php?action=update",
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
                    swal({title: 'Berhasil!', text: 'Data Lokasi berhasil disimpan.!', icon: 'success', timer: 1500,});
                   $('#modalEdit').modal('hide');
                   //setTimeout(function(){ location.reload(); }, 1500);
                   loadSettingUmum();

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


/*------------ Delete -------------*/
 $(document).on('click', '.delete', function(){ 
        var id = $(this).attr("data-id");
          swal({
            text: "Anda yakin menghapus data ini?",
            icon: "warning",
              buttons: {
                cancel: true,
                confirm: true,
              },
            value: "delete",
          })

          .then((value) => {
            if(value) {
                loading();
                $.ajax({  
                     url:"mod/lokasi/proses.php?action=delete",
                     type:'POST',    
                     data:{id:id},  
                    success:function(data){ 
                        if (data == 'success') {
                            swal({title: 'Berhasil!', text: 'Data berhasil dihapus.!', icon: 'success', timer: 1500,});
                            setTimeout(function(){ location.reload(); }, 1500);
                        } else {
                            swal({title: 'Gagal!', text: data, icon: 'error', timer: 1500,});
                            
                        }
                     }  
                });  
           } else{  
            return false;
        }  
    });
}); 

$(".btn-print").on('click',function () {
    $("#printarea").show();
    window.print();
});


});