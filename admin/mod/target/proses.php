<?php
session_start();
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    header('location:../../login/');
 exit;}
else {
require_once'../../../library/sw-config.php';
require_once'../../login/login_session.php';
include('../../../library/sw-function.php');
$max_size = 2000000; //2MB
$salt = '$%DEf0&TTd#%dSuTyr47542"_-^@#&*!=QxR094{a911}+';

$bade = mysqli_real_escape_string($connection, $data['bade']);
$badenpr = mysqli_real_escape_string($connection, $data['badenpl']);
$badepar = mysqli_real_escape_string($connection, $data['badepar']);
$par = mysqli_real_escape_string($connection, $data['par']);
$npl = mysqli_real_escape_string($connection, $data['npl']);


$updateQuery = "UPDATE kpi SET bade = $bade , badenpr = $badenpr, badepar = $badepar , par = $par
, npl = $npl
WHERE user_id = 0 AND month = BASE";


// Define an array for the months
$months = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

// Initialize an empty data array
$data = [];

// Iterate through each month
foreach ($months as $index => $month) {
    if ($index === 0) {
        // For January
        $data[$month]['credit'] = $_POST[$month];
        $data[$month]['bade'] = $_POST['bade'] + $data[$month]['credit'];
        $data[$month]['badenpl'] = $_POST['badenpl'] - 500000;
        $data[$month]['npl'] = ($data[$month]['badenpl'] / $data[$month]['bade']) * 100;
        $data[$month]['par'] =$data[$month]['npl'] + 7;
        $data[$month]['badepar'] = ($data[$month]['par'] / 100) * $data[$month]['bade'];
    } else {
        // For other months
        $prevMonth = $months[$index - 1];
        $data[$month]['credit'] = $_POST[$month];
        $data[$month]['bade'] = $data[$prevMonth]['bade'] + $data[$month]['credit'];
        $data[$month]['badenpl'] = $data[$prevMonth]['badenpl'] - 500000;
        $data[$month]['npl'] = ($data[$month]['badenpl'] / $data[$month]['bade']) * 100;
        $data[$month]['par'] = $data[$month]['npl'] + 7;
        $data[$month]['badepar'] = ($data[$month]['par'] / 100) * $data[$month]['bade'];
    }

    // Check if the record exists in the table kpi for user_id = 0 and month = $month
    $checkExistQuery = "SELECT COUNT(*) as count FROM kpi WHERE month = '$month' AND user_id = 0";
    $existResult = $connection->query($checkExistQuery);
    $row = $existResult->fetch_assoc();
    $recordExists = $row['count'] > 0;

    // Construct the SQL query
    $sql = "INSERT INTO kpi (user_id, month, bade, badepar, badenpl, npl, par, credit) VALUES (0, '$month', {$data[$month]['bade']}, {$data[$month]['badepar']}, {$data[$month]['badenpl']}, {$data[$month]['npl']}, {$data[$month]['par']}, {$data[$month]['credit']})";

    if ($recordExists) {
        // If the record exists, update it
        $sql = "UPDATE kpi SET bade = {$data[$month]['bade']}, badepar = {$data[$month]['badepar']}, badenpl = {$data[$month]['badenpl']}, npl = {$data[$month]['npl']}, par = {$data[$month]['par']}, credit = {$data[$month]['credit']} WHERE user_id = 0 AND month = '$month'";
    }

    // Execute the SQL query
    $connection->query($sql);
}

echo 'sucess';




}
?>