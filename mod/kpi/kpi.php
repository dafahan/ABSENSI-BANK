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
            <div class="section-title">Data Absensi</div>
            <div class="card">
                <div class="table-responsive">
                <div class="loaddatakpi">
                <table class="table rounded" id="swdatatable">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle text-center">Bulan</th>
                            <th scope="col" class="align-middle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $year = $_GET['year'];
                    $months = [
                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                    ];
            
                    foreach ($months as $month) {
                        echo '<tr>';
                        echo '<th class="text-center">' . $month . '</th>';
                        echo '<td class="text-center">';
                        
                        echo '<a href="'.$year."/".strtolower($month).'" class="btn btn-success btn-sm modal-update"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '
                    </tbody>
            </table>  
            </div>
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