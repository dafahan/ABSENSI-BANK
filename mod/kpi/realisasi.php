<?php 
if ($mod ==''){
    header('location:../404');
    echo'kosong';
}else{
    include_once 'mod/sw-header.php';
    $Month = ($_GET['month']);
    $data = [];

// Get all data for user_id = 0
$getAllDataQuery = "SELECT * FROM kpi WHERE user_id = 0";

$result = $connection->query($getAllDataQuery);

// Check if data exists
if ($result->num_rows > 0) {
    // Fetch data and store it in $data array
    while ($row = $result->fetch_assoc()) {
        $month = $row['month'];

        // Store data for each column in $data array
        $data[$month]['bade'] = $row['bade'];
        $data[$month]['badenpl'] = $row['badenpl'];
        $data[$month]['badepar'] = $row['badepar'];
        $data[$month]['par'] = $row['par'];
        $data[$month]['npl'] = $row['npl'];
        $data[$month]['credit'] = $row['credit'];
    }
} else {
    echo "No data found for user_id = 0";
}

if(!isset($_COOKIE['COOKIES_MEMBER']) && !isset($_COOKIE['COOKIES_COOKIES'])){
        setcookie('COOKIES_MEMBER', '', 0, '/');
        setcookie('COOKIES_COOKIES', '', 0, '/');
        // Login tidak ditemukan
        setcookie("COOKIES_MEMBER", "", time()-$expired_cookie);
        setcookie("COOKIES_COOKIES", "", time()-$expired_cookie);
        session_destroy();
        header("location:./index");
}else{

    ?>
    <!-- App Capsule -->
    <div id="appCapsule">
   

        <div class="section mt-2">
            <div class="section-title">Data Absensi</div>
            <div class="card">
                <div class="table-responsive">
                <div class="loaddatakpi">
                <table class="table rounded" id="swdatatable">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle text-center">Pertumbuhan Kredit</th>
                            <th scope="col" class="align-middle text-center">Target</th>
                            <th scope="col" class="align-middle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $year = $_GET['year'];
                    $columns = [
                        'BADE' => 'bade',
                        'bade NPL' => 'badenpl',
                        'bade PAR' => 'badepar',
                        '-NPL' => 'npl',
                        '-PAR' => 'par'
                    ];
                    
                    foreach ($columns as $label => $key) {
                        echo '<tr>';
                        echo '<th class="text-center">' . $label . '</th>';
                        echo '<td class="text-center">';
                        echo ($key == 'npl' || $key == 'par') ?  number_format($data[$month][$key],2, ', ', '.'). '%' : 'Rp' .number_format($data[$month][$key], 0, ',', '.') ;
                        echo '</td>';
                        echo '<td class="text-center">';
                        echo '<input type="number" class="col-sm-6" required>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                
                    </tbody>
            </table>  
            </div>
                </div>
            </div>
             <div class="alert alert-warning mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Alert!!</a>
            </div>
        </div>
    

        


       
        <!-- * END UPDATE ABSENSI -->

</div>';
<?php

                                            }

include_once 'mod/sw-footer.php';
} ?>