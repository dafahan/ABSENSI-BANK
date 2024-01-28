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


$userId = epm_decode($_COOKIE['COOKIES_MEMBER']);
$Y3ar = $_GET['year'];
$getAllData = "SELECT * FROM kpi 
WHERE month = '$Month' AND year = '$Y3ar' AND user_id = '$userId'";

$result = $connection->query($getAllData);

if ($result === false) {
    echo "Error fetching data: " . $connection->error;
} else {
    // Fetch data and save to an array
    $dataArray = array();

    while ($row = $result->fetch_assoc()) {
        $dataArray[] = $row;
    }

   
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
    <?php
    
    if (isset($_POST['submit'])) {
        
        $year = $_POST['year'];
        $month = $_POST['month'];
        $bade = $_POST['bade'];
        $badenpl = $_POST['badenpl'];
        $badepar = $_POST['badepar'];
        $npl = $_POST['npl'];
        $par = $_POST['par'];
        $user_id = epm_decode($_COOKIE['COOKIES_MEMBER']);
        $credit = $_POST['credit'];
        $sqlCheckExistence = "SELECT * FROM kpi 
                          WHERE month = '$month' AND year = '$year' AND user_id = '$user_id'";


        $result = $connection->query($sqlCheckExistence);

        if ($result->num_rows > 0) {
             $sqlUpdate = "UPDATE kpi 
                SET bade = '$bade', badenpl = '$badenpl', badepar = '$badepar', npl = '$npl', par = '$par' , credit = '$credit'
                           WHERE month = '$month' AND year = '$year' AND user_id = '$user_id'";
             $connection->query($sqlUpdate);
           
            
        }else{
             $sqlInsert = "INSERT INTO kpi (year, month, bade, badenpl, badepar, npl, par, user_id,credit) 
                           VALUES ('$year', '$month', '$bade', '$badenpl', '$badepar', '$npl', '$par', '$user_id',$credit)";
             $connection->query($sqlInsert);
            
        }


        $sqlLatestMonthData = "SELECT * FROM kpi 
                       WHERE user_id = '$user_id' AND year = '$year'
                       ORDER BY FIELD(month, 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember') DESC";

        $result = $connection->query($sqlLatestMonthData);
        $latestMonthData = null;
        if ($result === false) {
            echo "Error fetching latest month data: " . $connection->error;
        } else {
            if ($result->num_rows > 0) {
                // Fetch all data for the latest month
                $latestMonthData = $result->fetch_all(MYSQLI_ASSOC);

                // Output or process the data as needed
            } else {
                echo "No data found for the specified user_id and year.";
            }
        }

        $targetDesember = "SELECT * FROM kpi 
        WHERE user_id = '0' AND month = 'desember'";

        $res = $connection->query($targetDesember);
        $targetDes = null;
        if ($res === false) {
        echo "Error fetching latest month data: " . $connection->error;
        } else {
        if ($res->num_rows > 0) {
        // Fetch all data for the latest month
        $targetDes = $res->fetch_all(MYSQLI_ASSOC);

        // Output or process the data as needed
        } else {
        echo "No data found for the specified user_id and year.";
        }
        }
        $tes = $latestMonthData;
        if($latestMonthData['month'] = $month ){
            $scoreBade = $bade/$targetDes[0]['bade']*100;
            // $tes = $bade;
            $scoreNpl = 100+ (($targetDes[0]['badenpl']-$badenpl)/$targetDes[0]['badenpl'])*100;
            $scorePar = 100+ (($targetDes[0]['badepar']-$badepar)/$targetDes[0]['badepar'])*100;

        }else{
            $scoreBade = $latestMonthData[0]['bade']/$targetDes[0]['bade']*100;
            $scoreNpl = 100+ (($targetDes[0]['badenpl']-$latestMonthData[0]['badenpl'])/$targetDes[0]['badenpl'])*100;
            $scorePar = 100+ (($targetDes[0]['badepar']-$latestMonthData[0]['badepar'])/$targetDes[0]['badepar'])*100;
            
        }
        $sqlCheckExistence = "SELECT * FROM item_kpi 
         WHERE year = '$year' AND user_id = '$user_id'";

        
         $result = $connection->query($sqlCheckExistence);

         if ($result->num_rows > 0) {
         $sqlUpdate = "UPDATE item_kpi 
         SET bade = '$scoreBade', npl = '$scoreNpl', par = '$scorePar'
                 WHERE year = '$year' AND user_id = '$user_id'";
                // $tes= $sqlUpdate;
         $connection->query($sqlUpdate);


         }else{
         $sqlInsert = "INSERT INTO item_kpi (year, bade, npl, par,user_id) 
                 VALUES ('$year', '$scoreBade', '$scoreNpl', '$scorePar', '$user_id')";
         $connection->query($sqlInsert);
           // $tes = $sqlInsert;
         }

          $currentUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header("Location: $currentUrl");
            exit(); // Ensure that no further code is executed
    }
     
    ?>
    
        <div class="section mt-2">
            <?php 
                print_r($tes);
?>
            <div class="section-title">Nilai Realisasi</div>
            <div class="card" style="">
            <form method="post" class="form-horizontal validate add-karyawan">

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
                        'Relasi Kredit' => 'credit',
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
                        echo ($key == 'npl' || $key == 'par') ?  number_format($data[$Month][$key],2, ', ', '.'). '%' : 'Rp' .number_format($data[$month][$key], 0, ',', '.') ;
                        echo '</td>';
                        echo '<td class="text-center">';
                        echo '<input type="text" class="col-sm-6" name="' . $key . '" id="' . $key . '" value="' . (isset($dataArray[0][$key]) ? $dataArray[0][$key] : '') . '" '.(($key == 'npl' || $key == 'par') ? 'readonly' : '').' required>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    <!-- Your existing PHP/HTML code -->

                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
    // Attach input event listeners for dynamic input fields
    $('#badenpl').on('input', function() {
        calculateNPLPAR();
    });

    $('#bade').on('input', function() {
        calculateNPLPAR();
    });

    $('#badepar').on('input', function() {
        calculateNPLPAR();
    });

    // Function to calculate NPL and PAR
    function calculateNPLPAR() {
        var badenpl = parseFloat($('#badenpl').val()) || 0;
        var bade = parseFloat($('#bade').val()) || 1; // Avoid division by zero
        var badepar = parseFloat($('#badepar').val()) || 0;

        // Calculate NPL and PAR
        var npl = (badenpl / bade * 100).toFixed(2);
        var par = (badepar / bade * 100).toFixed(2);

        // Update the readonly input fields
        $('#npl').val(npl );
        $('#par').val(par );
    }
});
</script>

                    
                    <input type="hidden" name="year" value="<?php echo $year;?>">
                    
                    <input type="hidden" name="month" value="<?php echo $Month;?>">
                    </tbody>
            </table>  
            </div>

                </div>
                <div style="display:flex;width: 100%;height:10vh;justify-content:center;align-items:center;">
            <button type="submit" name="submit"  class="btn btn-primary" style="max-width:60%;">SIMPAN</button>

                </div>
                </form>
            </div>

            
            </div>
             <div class="alert alert-warning mt-2" role="alert">
                <ion-icon name="alert-circle-outline"></ion-icon> Alert!!</a>
            </div>
        </div>
    
       
       
        <!-- * END UPDATE ABSENSI -->

</div>
<?php

                                            }

include_once 'mod/sw-footer.php';
} ?>