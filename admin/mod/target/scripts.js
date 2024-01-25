$(document).ready(function () {
  function loading() {
    $(".loading").show();
    $(".loading").delay(1500).fadeOut(500);
  }

  /* ----------- Add ------------*/
  $(".add-karyawan").submit(function (e) {
    if ($("#building").val() == "") {
      swal({
        title: "Oops!",
        text: "Harap bidang inputan tidak boleh ada yang kosong.!",
        icon: "error",
        timer: 1500,
      });
      return false;
      loading();
    } else {
      loading();
      e.preventDefault();
      $.ajax({
        url: "mod/target/proses.php",
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
          swal({
            title: "Berhasil!",
            text: "Data Pengguna berhasil disimpan.!",
            icon: "success",
            timer: 1500,
          });

          //setTimeout(function(){location.reload(); }, 1500);
          window.setTimeout((window.location.href = "./target"), 2500);
        },
        complete: function () {
          $(".loading").hide();
        },
      });
    }
  });
});
