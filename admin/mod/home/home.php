<?php
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';

  $query_employees ="SELECT id FROM employees";
  $result_count = $connection->query($query_employees);

  $query_position ="SELECT position_id FROM position";
  $result_count_position = $connection->query($query_position);

  $query_building ="SELECT building_id FROM building";
  $result_count_building = $connection->query($query_building);

  $query_shift ="SELECT shift_id FROM shift";
  $result_count_shift = $connection->query($query_shift);


echo'
<div class="content-wrapper">
<section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>'.$result_count->num_rows.'</h3>
              <p>Pengguna</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
              <a href="./karyawan" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>'.$result_count_position->num_rows.'</h3>
              <p>Jabatan</p>
            </div>
            <div class="icon">
              <i class="fa fa fa-briefcase"></i>
            </div>
            <a href="./jabatan" class="small-box-footer">
             Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>'.$result_count_building->num_rows.'</h3>
              <p>Lokasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-building"></i>
            </div>
            <a href="./lokasi" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>'.$result_count_shift->num_rows.'</h3>
              <p>Penempatan</p>
            </div>
            <div class="icon">
              <i class="fa fa-retweet"></i>
            </div>
            <a href="./shift" class="small-box-footer">
              Selengkapnya <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Statistik Absensi</h3>
        </div>
        <div class="box-body">
          <div class="chart">
             <canvas id="areaChart" style="height:400px"></canvas>
          </div>
        </div>
        </div>
      </div>
</section>
</div>';


  $date = date("d-m-Y",strtotime("-6 days"));
    $D = substr($date,0,2);
    $M = substr($date,3,2)-1;
    $Y = substr($date,6,4);
    $tgl_skrg = date("Y-m-d");
    $seminggu = strtotime("-1 week +1 day",strtotime($tgl_skrg));
    $hasilnya = date('Y-m-d', $seminggu);
    //visitor
    for ($i=0; $i<=6; $i++){
      $tgl_pengujung   = strtotime("+$i day",strtotime($hasilnya));
      $hasil_pengujung = date("Y-m-d", $tgl_pengujung);
      $tanggal_visitor []= tgl_ind($hasil_pengujung);
      $query_absensi ="SELECT presence_date FROM presence WHERE presence_date='$hasil_pengujung'";
      $result_absensi = $connection->query($query_absensi);
      $absensi [] = $result_absensi->num_rows;

    }
 $tanggal_visitor = implode('","',$tanggal_visitor);?>
 <script type="text/javascript">
    var lineChartData = {
      labels :["<?php echo $tanggal_visitor;?>"],
      datasets : [
        {
          label: "Statistik Absensi",
          fillColor : "rgba(29,75,251,0.7)",
          strokeColor : "rgba(220,220,220,1)",
          pointColor : "rgba(220,220,220,1)",
          pointStrokeColor : "#fff",
          pointHighlightFill : "#fff",
          pointHighlightStroke : "rgba(220,220,220,1)",
          data :<?php echo json_encode($absensi);?>

        }
      ]

    }

  window.onload = function(){
    var ctx = document.getElementById("areaChart").getContext("2d");
    window.myLine = new Chart(ctx).Line(lineChartData, {
      responsive: true
    });
  }
 
</script>
<?PHP
}?>
