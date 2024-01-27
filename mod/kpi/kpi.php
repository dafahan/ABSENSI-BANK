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
    $user_id = epm_decode($_COOKIE['COOKIES_MEMBER']);
    $year = $_GET['year'];
    
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
                    
                    foreach ($months as $key => $month) {
                        echo '<tr>';
                        echo '<th class="text-center">' . $month . '</th>';
                        echo '<td class="text-center">';
                        
                        if ($key === 0) {
                            // Always enable the button for Januari
                            echo '<a href="'.$year."/".strtolower($month).'" class="btn btn-success btn-sm "><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                        } else {
                            $prevMonth = $months[$key - 1];
                            $lowerPrev = strtolower($prevMonth);
                            // Check if data for the previous month exists
                            $sqlCheckPrevMonthExistence = "SELECT COUNT(*) as count FROM kpi 
                                                           WHERE user_id = '$user_id' AND year = '$year' AND month = '$lowerPrev'";
                            
                            $resultCheckPrevMonth = $connection->query($sqlCheckPrevMonthExistence);
                    
                            if ($resultCheckPrevMonth === false) {
                                echo "Error checking previous month existence: " . $connection->error;
                            } else {
                                $rowCheckPrevMonth = $resultCheckPrevMonth->fetch_assoc();
                    
                                if ($rowCheckPrevMonth['count'] > 0) {
                                    // Data for the previous month exists, enable the button
                                    echo '<a href="'.$year."/".strtolower($month).'" class="btn btn-success btn-sm modal-update"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>';
                                } else {
                                    // Data for the previous month does not exist, disable the button
                                    echo '<button class="btn btn-sm" disabled><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>';
                                }
                            }
                        }
                        
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
        

</div>';

                                            }

include_once 'mod/sw-footer.php';
} ?>