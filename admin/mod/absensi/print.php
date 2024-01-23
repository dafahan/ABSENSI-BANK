<?php session_start();
    require_once'../../../library/sw-config.php'; 
    require_once'../../../library/sw-function.php';
    include_once'../../../library/vendor/autoload.php';
if(empty($_SESSION['SESSION_USER']) && empty($_SESSION['SESSION_ID'])){
    //Kondisi tidak login
   header('location:../login/');
}

else{
  //kondisi login
switch (@$_GET['action']){
/* -------  CETAK PDF-----------------------------------------------*/
case 'pdf':
  if (empty($_GET['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection, $_GET['id']);
  }

if (empty($error)) {
  $query ="SELECT employees.id,employees.employees_name,employees.position_id,position.position_name,employees.shift_id FROM employees,position WHERE employees.position_id=position.position_id AND employees.id='$id'";
  $result = $connection->query($query);

  if($result->num_rows > 0){
      $row            = $result->fetch_assoc();
      $employees_name = $row['employees_name'];

      if(isset($_GET['from']) OR isset($_GET['to'])){
          $bulan   = date ($_GET['from']);
      } 
      else{
          $bulan  = date ("m");
      }
        $hari       = date("d");
        $tahun      = date("Y");
        $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
        $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));
        $mpdf = new \Mpdf\Mpdf();
        ob_start();
    
  $mpdf->SetHTMLFooter('
      <table width="100%" style="border-top:solid 1px #333;font-size:11px;">
          <tr>
              <td width="60%" style="text-align:left;">Simpanlah lembar Absensi ini.</td>
              <td width="35%" style="text-align: right;">Dicetak tanggal '.tgl_indo($date).'</td>
          </tr>
      </table>');
echo'<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>
    <title>Cetak Data Absensi '.$employees_name.'</title>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{line-height:25px;font-size:20px;margin:0px 0 10px;text-transform:uppercase}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{font-size:30px}table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}
    .label {display: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap; vertical-align: baseline;border-radius: .25em;}
    .label-success{background-color: #00B4FF !important;}.label-warning {background-color: #F6B310;}.label-info {background-color: #5bc0de;}.label-danger{background-color: #00B4FF !important;}
    p{line-height:20px;padding:0px;margin: 5px;}.pull-right{float:right}
    </style>
</head>
<body>';
echo'
    <section class="container_box">
      <div class="row">';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($_GET['from']).' - '.$_GET['to'].'</h3>';}
        else{
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($month).' - '.$year.'</h3>';
      }
        echo'
        <p>Nama   : '.$row['employees_name'].'</p>
        <p>Devisi : '.$row['position_name'].'</p><br>
      <div class="content_box">
        <table class="customTable">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Tanggal</th>
              <th>Waktu Masuk</th>
              <th>Waktu Pulang</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
          </thead>
        <tbody>';
         for ($d=1;$d<=$jumlahhari;$d++) {
            $warna      = '';
            $background = '';
            $status     = 'Tidak Hadir';
          if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
            $warna='white';
            $background ='#005CAA';
            $status ='Libur Akhir Pekan';
        }
      $date_month_year = ''.$year.'-'.$month.'-'.$d.'';

      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date)='$month' AND year(presence_date)='$year'";
      } 
      else{
        $filter ="employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date) ='$month'";
      }

      $query_shift ="SELECT time_in,time_out FROM shift WHERE shift_id='$row[shift_id]'";
      $result_shift = $connection->query($query_shift);
      $row_shift = $result_shift->fetch_assoc();
      $shift_time_in = $row_shift['time_in'];
      $newtimestamp = strtotime(''.$shift_time_in.' + 05 minute');
      $newtimestamp = date('H:i:s', $newtimestamp);

      $query_absen ="SELECT presence_id,presence_date,time_in,time_out,picture_in,picture_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE $filter ORDER BY presence_id DESC";
      $result_absen = $connection->query($query_absen);
      $row_absen = $result_absen->fetch_assoc();

      $querya ="SELECT present_id,present_name FROM present_status WHERE present_id='$row_absen[present_id]'";
      $resulta= $connection->query($querya);
      $rowa =  $resulta->fetch_assoc();

          if($row_absen['time_in'] == NULL){
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
              $status ='Libur Akhir Pekan';
            }else{
              $status ='<span class="label label-danger">Tidak Hadir</span>';
            }
            $time_in = $row_absen['time_in']; 
          }
          else{
            $status = $rowa['present_name'];
            $time_in = $row_absen['time_in']; 
          }


        if($row_absen['status']=='Telat'){
          $status_time_in ='<label class="label label-danger pull-right">'.$row_absen['status'].'</label>';
        }
          elseif ($row_absen['status']=='Tepat Waktu') {
          $status_time_in ='<label class="label label-info pull-right">'.$row_absen['status'].'</label>';
        }
        else{
          $status_time_in ='';
        }


        echo'
         <tr style="background:'.$background.';color:'.$warna.'">
            <td class="text-center">'.$d.'</td>
            <td>'.format_hari_tanggal($date_month_year).'</td>';
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_in'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                <td>'.$row_absen['time_in'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_in'].'</td>';
            }
          
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_out'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                  <td>'.$row_absen['time_out'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_out'].'</td>';
            }
            echo'
              <td>'.$status.' '.$status_time_in.'</td>
              <td>'.$row_absen['information'].'</td>
          </tr>';
        }
  
      echo'<tbody>
      </table>';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
      } 
      else{
        $filter ="employees_id='$id' AND MONTH(presence_date) ='$month' AND employees_id='$id'";
      }

      $query_hadir="SELECT presence_id FROM presence WHERE $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);

      echo'<p>Hadir : <span class="label label-success">'.$hadir->num_rows.'</span></p>
          <p>Telat : <span class="label label-primary">'.$telat->num_rows.'</span></p>
          <p>Sakit : <span class="label label-warning">'.$sakit->num_rows.'</span></p>
          <p>Izin : <span class="label label-danger">'.$izin->num_rows.'</span></p>

      </div>
    </div>
  </section>
</body>
</html>';
  $html = ob_get_contents(); 
  ob_end_clean();
  $mpdf->WriteHTML(utf8_encode($html));
  $mpdf->Output("Absensi-$employees_name-$date.pdf" ,'I');
}else{
  echo'<center><h3>Data Tidak Ditemukan</h3></center>';
}
}else{
  echo'Data tidak boleh ada yang kosong!';
}

//Explore to Excel -------------------------------------------------------
break;
case 'excel':
  
if (empty($_GET['id'])) {
      $error[] = 'ID tidak boleh kosong';
    } else {
      $id = mysqli_real_escape_string($connection, $_GET['id']);
  }

if (empty($error)) {
  $query ="SELECT employees.id,employees.employees_name,employees.shift_id,employees.position_id,position.position_name FROM employees,position WHERE employees.position_id=position.position_id AND employees.id='$id'";
  $result = $connection->query($query);

  if($result->num_rows > 0){
      $row            = $result->fetch_assoc();
      $employees_name = $row['employees_name'];

      if(isset($_GET['from']) OR isset($_GET['to'])){
          $bulan   = date ($_GET['from']);
      } 
      else{
          $bulan  = date ("m");
      }

      $hari       = date("d");
      $tahun      = date("Y");
      $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
      $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));
      $mpdf = new \Mpdf\Mpdf();
      ob_start();

if (empty($_GET['print'])) {
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data-Absensi-$employees_name-$date.xls");
    }
else {
echo'<script>
      window.print();
    </script>';  
}
    



echo'<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>
    <title>Cetak Data Absensi '.$employees_name.'</title>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{line-height:25px;font-size:20px;margin:0px 0 10px;text-transform:uppercase}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{font-size:30px}table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}
    .label {display: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap; vertical-align: baseline;border-radius: .25em;}
    .label-success{background-color: #00B4FF !important;}.label-warning {background-color: #F6B310;}.label-info {background-color: #5bc0de;}.label-danger{background-color: #00B4FF !important;}
    p{line-height:20px;padding:0px;margin: 5px;}.pull-right{float:right}
    </style>
  <script>
     window.print();
  </script>
</head>
<body>';
echo'
    <section class="container_box">
      <div class="row">';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($_GET['from']).' - '.$_GET['to'].'</h3>';}
        else{
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($month).' - '.$year.'</h3>';
        }
        echo'
        <p>Nama   : '.$row['employees_name'].'</p>
        <p>Devisi : '.$row['position_name'].'</p><br>
        <div class="content_box">
        <table class="customTable">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Tanggal</th>
              <th>Waktu Masuk</th>
              <th>Waktu Pulang</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
          </thead>
        <tbody>';
         for ($d=1;$d<=$jumlahhari;$d++) {
            $warna      = '';
            $background = '';
            $status     = 'Tidak Hadir';
          if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
            $warna='white';
            $background ='#005CAA';
            $status ='Libur Akhir Pekan';
        }
      $date_month_year = ''.$year.'-'.$month.'-'.$d.'';

      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date)='$month' AND year(presence_date)='$year'";
      } 
      else{
        $filter ="employees_id='$id' AND  presence_date='$date_month_year' AND MONTH(presence_date) ='$month'";
      }


      $query_shift ="SELECT time_in,time_out FROM shift WHERE shift_id='$row[shift_id]'";
      $result_shift = $connection->query($query_shift);
      $row_shift = $result_shift->fetch_assoc();
      $shift_time_in = $row_shift['time_in'];
      $newtimestamp = strtotime(''.$shift_time_in.' + 05 minute');
      $newtimestamp = date('H:i:s', $newtimestamp);

      $query_absen ="SELECT presence_id,presence_date,time_in,time_out,picture_in,picture_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE $filter ORDER BY presence_id DESC";
      $result_absen = $connection->query($query_absen);
      $row_absen = $result_absen->fetch_assoc();

      $querya ="SELECT present_id,present_name FROM present_status WHERE present_id='$row_absen[present_id]'";
      $resulta= $connection->query($querya);
      $rowa =  $resulta->fetch_assoc();

          if($row_absen['time_in'] == NULL){
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
              $status ='Libur Akhir Pekan';
            }else{
              $status ='<span class="label label-danger">Tidak Hadir</span>';
            }
            $time_in = $row_absen['time_in']; 
          }
          else{
              $status = $rowa['present_name'];
              $time_in = $row_absen['time_in']; 
          }

         // Status Absensi Jam Masuk
        if($row_absen['status']=='Telat'){
          $status_time_in ='<label class="label label-danger pull-right">'.$row_absen['status'].'</label>';
        }
          elseif ($row_absen['status']=='Tepat Waktu') {
          $status_time_in ='<label class="label label-info pull-right">'.$row_absen['status'].'</label>';
        }
        else{
          $status_time_in ='';
        }
        echo'
         <tr style="background:'.$background.';color:'.$warna.'">
            <td class="text-center">'.$d.'</td>
            <td>'.format_hari_tanggal($date_month_year).'</td>';
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_in'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                <td>'.$row_absen['time_in'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_in'].'</td>';
            }
          
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_out'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                  <td>'.$row_absen['time_out'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_out'].'</td>';
            }
            echo'
              <td>'.$status.' '.$status_time_in.'</td>
              <td>'.$row_absen['information'].'</td>
          </tr>';
        }
  
      echo'<tbody>
      </table>';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
      } 
      else{
        $filter ="employees_id='$id' AND MONTH(presence_date) ='$month' AND employees_id='$id'";
      }

      $query_hadir="SELECT presence_id FROM presence WHERE $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);

      echo'<p>Hadir : <span class="label label-success">'.$hadir->num_rows.'</span></p>
          <p>Telat : <span class="label label-primary">'.$telat->num_rows.'</span></p>
          <p>Sakit : <span class="label label-warning">'.$sakit->num_rows.'</span></p>
          <p>Izin : <span class="label label-danger">'.$izin->num_rows.'</span></p>

        </div>
      </div>
    </section>
</body>
</html>';
    }else{
      echo'<center><h3>Data Tidak Ditemukan</h3></center>';
    }
    }else{
      echo'Data tidak boleh ada yang kosong!';
    }

break;
/* -------  CETAK ALL Pengguna PDF-----------------------------------------------*/
case 'allpdf':
  $query ="SELECT employees.id,employees.employees_name,employees.position_id,position.position_name,shift.time_in,shift.time_out FROM employees,position,shift WHERE employees.position_id=position.position_id AND employees.shift_id=shift.shift_id ORDER BY employees.id DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
      while ($row= $result->fetch_assoc()) {
      $employees_name = $row['employees_name'];
      $id             = $row['id'];

      if(isset($_GET['from']) OR isset($_GET['to'])){
          $bulan   = date ($_GET['from']);
      } 
      else{
          $bulan  = date ("m");
      }
        $hari       = date("d");
        $tahun      = date("Y");
        $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
        $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));
        $mpdf = new \Mpdf\Mpdf();
        ob_start();

      $shift_time_in  = $row['time_in'];
      $newtimestamp   = strtotime(''.$shift_time_in.' + 05 minute');
      $newtimestamp   = date('H:i:s', $newtimestamp);
    
  $mpdf->SetHTMLFooter('
      <table width="100%" style="border-top:solid 1px #333;font-size:11px;">
          <tr>
              <td width="60%" style="text-align:left;">Simpanlah lembar Absensi ini.</td>
              <td width="35%" style="text-align: right;">Dicetak tanggal '.tgl_indo($date).'</td>
          </tr>
      </table>');
echo'<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>
    <title>Cetak Data Absensi '.$employees_name.'</title>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{line-height:25px;font-size:20px;margin:0px 0 10px;text-transform:uppercase}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{font-size:30px}table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}
    .label {display: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap; vertical-align: baseline;border-radius: .25em;}
    .label-success{background-color: #00B4FF !important;}.label-warning {background-color: #F6B310;}.label-info {background-color: #5bc0de;}.label-danger{background-color: #00B4FF !important;}
    p{line-height:20px;padding:0px;margin: 5px;}.pull-right{float:right}
    </style>
</head>
<body>';
echo'
    <section class="container_box">
      <div class="row">';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($_GET['from']).' - '.$_GET['to'].'</h3>';}
        else{
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($month).' - '.$year.'</h3>';
      }
        echo'
        <p>Nama   : '.$row['employees_name'].'</p>
        <p>Devisi : '.$row['position_name'].'</p><br>
      <div class="content_box">
        <table class="customTable">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Tanggal</th>
              <th>Waktu Masuk</th>
              <th>Waktu Pulang</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
          </thead>
        <tbody>';
         for ($d=1;$d<=$jumlahhari;$d++) {
            $warna      = '';
            $background = '';
            $status     = 'Tidak Hadir';
          if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
            $warna='white';
            $background ='#005CAA';
            $status ='Libur Akhir Pekan';
        }
      $date_month_year = ''.$year.'-'.$month.'-'.$d.'';

      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date)='$month' AND year(presence_date)='$year'";
      } 
      else{
        $filter ="employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date) ='$month'";
      }


      $query_absen ="SELECT presence_id,presence_date,time_in,time_out,picture_in,picture_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE $filter";
      $result_absen = $connection->query($query_absen);
      $row_absen = $result_absen->fetch_assoc();

      $querya ="SELECT present_id,present_name FROM present_status WHERE present_id='$row_absen[present_id]'";
      $resulta= $connection->query($querya);
      $rowa =  $resulta->fetch_assoc();

          if($row_absen['time_in'] == NULL){
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
              $status ='Libur Akhir Pekan';
            }else{
              $status ='<span class="label label-danger">Tidak Hadir</span>';
            }
            $time_in = $row_absen['time_in']; 
          }
          else{
            $status = $rowa['present_name'];
            $time_in = $row_absen['time_in']; 
          }


        if($row_absen['status']=='Telat'){
          $status_time_in ='<label class="label label-danger pull-right">'.$row_absen['status'].'</label>';
        }
          elseif ($row_absen['status']=='Tepat Waktu') {
          $status_time_in ='<label class="label label-info pull-right">'.$row_absen['status'].'</label>';
        }
        else{
          $status_time_in ='';
        }


        echo'
         <tr style="background:'.$background.';color:'.$warna.'">
            <td class="text-center">'.$d.'</td>
            <td>'.format_hari_tanggal($date_month_year).'</td>';
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_in'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                <td>'.$row_absen['time_in'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_in'].'</td>';
            }
          
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_out'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                  <td>'.$row_absen['time_out'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_out'].'</td>';
            }
            echo'
              <td>'.$status.' '.$status_time_in.'</td>
              <td>'.$row_absen['information'].'</td>
          </tr>';
        }
  
      echo'<tbody>
      </table>';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
      } 
      else{
        $filter ="employees_id='$id' AND MONTH(presence_date) ='$month' AND employees_id='$id'";
      }

      $query_hadir="SELECT presence_id FROM presence WHERE $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);

      echo'<p>Hadir : <span class="label label-success">'.$hadir->num_rows.'</span></p>
          <p>Telat : <span class="label label-primary">'.$telat->num_rows.'</span></p>
          <p>Sakit : <span class="label label-warning">'.$sakit->num_rows.'</span></p>
          <p>Izin : <span class="label label-danger">'.$izin->num_rows.'</span></p>

      </div>
    </div>
  </section>
</body>
</html>';}
  $html = ob_get_contents(); 
  ob_end_clean();
  $mpdf->WriteHTML(utf8_encode($html));
  $mpdf->Output("Absensi-$employees_name-$date.pdf" ,'I');
}else{
  echo'<center><h3>Data Tidak Ditemukan</h3></center>';
}
break;


/* -------  CETAK ALL EXCEL-----------------------------------------------*/
case 'allexcel':
  $query ="SELECT employees.id,employees.employees_name,employees.position_id,position.position_name,shift.time_in,shift.time_out FROM employees,position,shift WHERE employees.position_id=position.position_id AND employees.shift_id=shift.shift_id ORDER BY employees.id DESC";
  $result = $connection->query($query);
  if($result->num_rows > 0){
      while ($row= $result->fetch_assoc()) {
      $employees_name = $row['employees_name'];
      $id             = $row['id'];

      if(isset($_GET['from']) OR isset($_GET['to'])){
          $bulan   = date ($_GET['from']);
      } 
      else{
          $bulan  = date ("m");
      }
        $hari       = date("d");
        $tahun      = date("Y");
        $jumlahhari = date("t",mktime(0,0,0,$bulan,$hari,$tahun));
        $s          = date ("w", mktime (0,0,0,$bulan,1,$tahun));
        $mpdf = new \Mpdf\Mpdf();
        ob_start();

      $shift_time_in  = $row['time_in'];
      $newtimestamp   = strtotime(''.$shift_time_in.' + 05 minute');
      $newtimestamp   = date('H:i:s', $newtimestamp);
  if (empty($_GET['print'])) {
      header("Content-type: application/vnd-ms-excel");
      header("Content-Disposition: attachment; filename=Data-Absensi-$date.xls");
    } else {
      echo'<script>
          window.print();
          </script>';
      
    }
    
echo'<!DOCTYPE html>
<html lang="id-ID" xml:lang="id-ID">
<head>
    <title>Cetak Data Absensi '.$employees_name.'</title>
    <style>
    body{font-family:Arial,Helvetica,sans-serif}.container_box{position:relative}.container_box .row h3{line-height:25px;font-size:20px;margin:0px 0 10px;text-transform:uppercase}.container_box .text-center{text-align:center}.container_box .content_box{position:relative}.container_box .content_box .des_info{margin:20px 0;text-align:right}.container_box h3{font-size:30px}table.customTable{width:100%;background-color:#fff;border-collapse:collapse;border-width:1px;border-color:#b3b3b3;border-style:solid;color:#000}table.customTable td,table.customTable th{border-width:1px;border-color:#b3b3b3;border-style:solid;padding:5px;text-align:left}table.customTable thead{background-color:#f6f3f8}.text-center{text-align:center}
    .label {display: inline;padding: .2em .6em .3em;font-size: 75%;font-weight: 700;line-height: 1;color: #fff;text-align: center;white-space: nowrap; vertical-align: baseline;border-radius: .25em;}
    .label-success{background-color: #00B4FF !important;}.label-warning {background-color: #F6B310;}.label-info {background-color: #5bc0de;}.label-danger{background-color: #00B4FF !important;}
    p{line-height:20px;padding:0px;margin: 5px;}.pull-right{float:right}
    </style>
</head>
<body>';
echo'
    <section class="container_box">
      <div class="row">';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($_GET['from']).' - '.$_GET['to'].'</h3>';}
        else{
        echo'<h3>DATA ABSENSI BULAN '.tanggal_indo($month).' - '.$year.'</h3>';
      }
        echo'
        <p>Nama   : '.$row['employees_name'].'</p>
        <p>Devisi : '.$row['position_name'].'</p><br>
      <div class="content_box">
        <table class="customTable">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Tanggal</th>
              <th>Waktu Masuk</th>
              <th>Waktu Pulang</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
          </thead>
        <tbody>';
         for ($d=1;$d<=$jumlahhari;$d++) {
            $warna      = '';
            $background = '';
            $status     = 'Tidak Hadir';
          if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
            $warna='white';
            $background ='#005CAA';
            $status ='Libur Akhir Pekan';
        }
      $date_month_year = ''.$year.'-'.$month.'-'.$d.'';

      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date)='$month' AND year(presence_date)='$year'";
      } 
      else{
        $filter ="employees_id='$id' AND presence_date='$date_month_year' AND MONTH(presence_date) ='$month'";
      }


      $query_absen ="SELECT presence_id,presence_date,time_in,time_out,picture_in,picture_out,present_id,presence_address,information,TIMEDIFF(TIME(time_in),'$shift_time_in') AS selisih,if (time_in>'$shift_time_in','Telat',if(time_in='00:00:00','Tidak Masuk','Tepat Waktu')) AS status FROM presence WHERE $filter";
      $result_absen = $connection->query($query_absen);
      $row_absen = $result_absen->fetch_assoc();

      $querya ="SELECT present_id,present_name FROM present_status WHERE present_id='$row_absen[present_id]'";
      $resulta= $connection->query($querya);
      $rowa =  $resulta->fetch_assoc();

          if($row_absen['time_in'] == NULL){
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday") {
              $status ='Libur Akhir Pekan';
            }else{
              $status ='<span class="label label-danger">Tidak Hadir</span>';
            }
            $time_in = $row_absen['time_in']; 
          }
          else{
            $status = $rowa['present_name'];
            $time_in = $row_absen['time_in']; 
          }


        if($row_absen['status']=='Telat'){
          $status_time_in ='<label class="label label-danger pull-right">'.$row_absen['status'].'</label>';
        }
          elseif ($row_absen['status']=='Tepat Waktu') {
          $status_time_in ='<label class="label label-info pull-right">'.$row_absen['status'].'</label>';
        }
        else{
          $status_time_in ='';
        }


        echo'
         <tr style="background:'.$background.';color:'.$warna.'">
            <td class="text-center">'.$d.'</td>
            <td>'.format_hari_tanggal($date_month_year).'</td>';
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_in'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                <td>'.$row_absen['time_in'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_in'].'</td>';
            }
          
            if (date("l",mktime (0,0,0,$bulan,$d,$tahun)) == "Sunday"){
              if($row_absen['time_out'] ==''){
                echo'
                <td class="text-center">Libur Akhir Pekan</td>';
              }
              else{
                echo'
                  <td>'.$row_absen['time_out'].'</td>';
              }

            }
            else{
            echo'
              <td>'.$row_absen['time_out'].'</td>';
            }
            echo'
              <td>'.$status.' '.$status_time_in.'</td>
              <td>'.$row_absen['information'].'</td>
          </tr>';
        }
  
      echo'<tbody>
      </table>';
      if(isset($_GET['from']) OR isset($_GET['to'])){
        $month = $_GET['from'];
        $year  = $_GET['to'];
        $filter ="employees_id='$id' AND MONTH(presence_date)='$month' AND year(presence_date)='$year' AND employees_id='$id'";
      } 
      else{
        $filter ="employees_id='$id' AND MONTH(presence_date) ='$month' AND employees_id='$id'";
      }

      $query_hadir="SELECT presence_id FROM presence WHERE $filter AND present_id='1' ORDER BY presence_id DESC";
      $hadir= $connection->query($query_hadir);

      $query_sakit="SELECT presence_id FROM presence WHERE $filter AND present_id='2' ORDER BY presence_id";
      $sakit = $connection->query($query_sakit);

      $query_izin="SELECT presence_id FROM presence WHERE $filter AND present_id='3' ORDER BY presence_id";
      $izin = $connection->query($query_izin);

      $query_telat ="SELECT presence_id FROM presence WHERE $filter AND time_in>'$shift_time_in'";
      $telat = $connection->query($query_telat);

      echo'<p>Hadir : <span class="label label-success">'.$hadir->num_rows.'</span></p>
          <p>Telat : <span class="label label-primary">'.$telat->num_rows.'</span></p>
          <p>Sakit : <span class="label label-warning">'.$sakit->num_rows.'</span></p>
          <p>Izin : <span class="label label-danger">'.$izin->num_rows.'</span></p>

      </div>
    </div>
  </section>
</body>
</html>';}
}else{
  echo'<center><h3>Data Tidak Ditemukan</h3></center>';
}

break;
}
}?>