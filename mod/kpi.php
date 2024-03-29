<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
if(!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])){
        setcookie('COOKIES_MEMBER', '', 0, '/');
        setcookie('COOKIES_COOKIES', '', 0, '/');
        // Login tidak ditemukan
        setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
        setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
        session_destroy();
        header("location:./index");
}else{
    
    echo'<!-- App Capsule -->
    <div id="appCapsule">
    <div class="section mt-2">
    <div class="card">
    <div class="card-body">
      
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Tambah Tahun
  </button>
'?>

<?php
if (isset($_POST['submit'])) {
    $e_id = epm_decode($_COOKIE['COOKIES_MEMBER']);
    $tahun_baru = $_POST['tahun'];
    $checkQuery = "SELECT COUNT(*) as count FROM years WHERE tahun = '$tahun_baru' AND employees_id = '$e_id'";
    $result = $connection->query($checkQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count == 0) {
            $insertQuery = "INSERT INTO years (tahun, employees_id) VALUES ('$tahun_baru', '$e_id')";
            $insertResult = $connection->query($insertQuery);

            if ($insertResult === false) {
                echo "Error inserting record: " . $connection->error;
            } else {
                echo "Record inserted successfully!";
            }
        } else {
            echo "Entry already exists!";
        }
    } else {
        echo "Error checking entry: " . $connection->error;
    }
    $currentUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
           header("Location: $currentUrl");
           exit(); 
}

?>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah tahun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" >
            <input type="number" class="form-control" name="tahun" min="2017" max="2999" required/>
            <button class="btn btn-primary" type="submit" name="submit">
                TAMBAH
            </button>
        </form>
       
      </div>
     
    </div>
  </div>
</div>
<?php echo'
  
              
    </div>
    </div>
    </div>

        <div class="section mt-2">
            <div class="section-title">Data Absensi</div>
            <div class="card">
                <div class="table-responsive">';

                $user_id = epm_decode($_COOKIE['COOKIES_MEMBER']);
  echo'<table class="table rounded" id="swdatatable">
      <thead>
          <tr>
              <th scope="col" class="align-middle text-center">Tahun</th>
              <th scope="col" class="align-middle text-center">Nilai</th>
              <th scope="col" class="align-middle text-center">Aksi</th>
          </tr>
      </thead>
      <tbody>';
     
      $query_tahun ="SELECT tahun,id FROM years WHERE employees_id='$row_user[id]' ORDER BY tahun DESC";
    $result_tahun = $connection->query($query_tahun);

    if ($result_tahun->num_rows > 0) {
        while ($row_tahun = $result_tahun->fetch_assoc()) {
            $tahun = $row_tahun['tahun'];

            // Fetch the score for the current user_id and year
            $query_score = "SELECT score FROM item_kpi WHERE user_id = '$user_id' AND year = '$tahun'";
            $result_score = $connection->query($query_score);

            $nilai = ($result_score->num_rows > 0) ? $result_score->fetch_assoc()['score'] : 'N/A';
            $keterangan = 'N/A';
            if ($nilai >= 111 && $nilai <= 120) {
                $keterangan = 'Sangat Baik';
            } elseif ($nilai >= 101 && $nilai <= 110) {
                $keterangan = 'Baik';
            } elseif ($nilai >= 91 && $nilai <= 100) {
                $keterangan = 'Cukup Baik';
            } elseif ($nilai >= 81 && $nilai <= 90) {
                $keterangan = 'Kurang Baik';
            } elseif ($nilai >= 0 && $nilai <= 80) {
                $keterangan = 'Tidak Baik';
            }

            echo '
            <tr>
                <th class="text-center">' . $tahun . '</th>
                <th class="text-center" scope="row">' . $nilai . ' (' . $keterangan . ')</th>
                <td class="text-center">
                    <a href="./kpi/' . $tahun . '" class="btn btn-success btn-sm modal-update" ><i class="fas fa-eye"></i></a>
                </td>
            </tr>';
        }
    }

      echo'
      </tbody>
  </table>';
       
  ?>
  
  <script>
    $('#swdatatable').dataTable({
      "iDisplayLength":35,
      "aLengthMenu": [[35, 40, 50, -1], [35, 40, 50, "All"]]
    });
   
  </script>
                
                

                    
                    <?php
                    echo'
                </div>
            </div>
             <div class="alert alert-warning mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Alert!!</a>
            </div>
        </div>
    

        <!-- MODAL EXPLORE -->
        <div class="modal fade action-sheet inset" id="modal-print" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cetak / Explore</h5>
                        <a href="javascript:void(0);" class="close" style="position: absolute;right:15px;top: 10px;"  data-dismiss="modal" aria-hidden="true"><ion-icon name="close-outline"></ion-icon></a>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">
                            <div class="form-group basic">
                                <div class="input-wrapper">
                                    <label class="label">Pilih Tipe</label>
                                    <select class="form-control custom-select type" name="type" required>
                                       <option value="excel">EXCEL</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group basic">
                                <button type="button" class="btn btn-primary btn-block mt-2 btn-print"><ion-icon name="print-outline"></ion-icon> Cetak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- UPDATE ABSENSI  -->
        <div class="modal fade action-sheet inset" id="modal-show" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" style="z-index:10000">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Absen Tanggal <span class="status-date badge badge-primary"></span></h5>
                        <a href="javascript:void(0);" class="close" style="position: absolute;right:15px;top: 10px;"  data-dismiss="modal" aria-hidden="true"><ion-icon name="close-outline"></ion-icon></a>
                    </div>
                    <div class="modal-body">
                        <div class="action-sheet-content">

                            <form id="update-history">
                                <input type="hidden" name="presence_id" id="presence_id" readonly>

                                <!--<div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">Jam Masuk</label>
                                        <input type="text" class="form-control" id="timein" name="time_in" value="" required>
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                    <span class="small">Format jam ex: 07:30</span>
                                </div>

                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">Jam Pulang</label>
                                        <input type="text" class="form-control" name="time_out" id="timeout" value="" required>
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                    <span class="small">Format jam ex: 17:00</span>
                                </div>-->


                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <label class="label">Kehadiran</label>
                                        <select class="form-control custom-select" name="present_id" id="status" required>';
                                            $query="SELECT * from present_status order by present_name ASC";
                                              $result = $connection->query($query);
                                              while($row = $result->fetch_assoc()) { 
                                              echo'<option value="'.$row['present_id'].'">'.$row['present_name'].'</option>';
                                              }echo'
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group basic">
                                    <label class="label">Keterangan</label>
                                    <div class="input-wrapper">
                                    <textarea id="information" rows="2" class="form-control" name="information" placeholder="Keterangan"></textarea>
                                    </div>
                                    <span class="small">Kosongkan jika tidak memberi keterangan</span>
                                </div>

                                <div class="form-group basic">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- * END UPDATE ABSENSI -->

</div>';

                                            }

include_once 'mod/sw-footer.php';
} ?>