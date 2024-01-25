<?php session_start();
if(empty($connection)){
  header('location:../../');
} else {
  include_once 'mod/sw-panel.php';
 
$getBaseDataQuery = "SELECT * FROM kpi WHERE user_id = 0 AND month = 'BASE'";
$baseDataResult = $connection->query($getBaseDataQuery);

// Check if data exists for user_id = 0 and month = 'BASE'
if ($baseDataResult->num_rows > 0) {
    $baseData = $baseDataResult->fetch_assoc();

    // Save data to $data array
    $data['bade'] = $baseData['bade'];
    $data['badenpl'] = $baseData['badenpl'];
    $data['badepar'] = $baseData['badepar'];
    $data['par'] = $baseData['par'];
    $data['npl'] = $baseData['npl'];
    $data['credit'] = $baseData['credit'];
} else {
   
    $data = [
        'bade' => 0,
        'badenpl' => 0,
        'badepar' => 0,
        'par' => 0,
        'npl' => 0,
        'credit' => 0
    ];
}
$months = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

foreach ($months as $month) {
   $getCreditQuery = "SELECT credit FROM kpi WHERE user_id = 0 AND month = '$month'";
    $creditResult = $connection->query($getCreditQuery);

    if ($creditResult->num_rows > 0) {
        $creditData = $creditResult->fetch_assoc();

        $data[$month] = $creditData['credit'];
    } else {
        //echo "No data found for user_id = 0 and month = '$month'";
        $data[$month] = 0;
    }
}


echo'
  <div class="content-wrapper">';
?>



<section class="content">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title"><b>SETTING TARGET KPI</b></h3>
        </div>

        <div class="box-body">
            <form  class="form-horizontal validate add-karyawan">
              <div class="box-body">
                
                <div class="form-group">
                
                  <label class="col-sm-5 control-label">BASE FIGURE</label>
                  
                  
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">BADE</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['bade'];?>" name="bade" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">bade NPL</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['badenpl'];?>" name="badenpl" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">bade PAR</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['badepar'];?>" name="badepar" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"> NPL (%)</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['npl'];?>" name="npl" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label"> PAR (%)</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['par'];?>" name="par" required>
                  </div>
                </div>

                <div class="form-group mt-3">
                
                  <label class="col-sm-5 control-label" style="margin-left:40px;margin-top:20px;">PERTUMBUHAN CREDIT</label>
                  
                  
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Januari</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['januari'];?>" name="januari" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Februari</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['februari'];?>" name="februari" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Maret</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['maret'];?>" name="maret" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">April</label>
                  <div class="col-sm-6"> 
                    <input type="number" class="form-control" value="<?php echo $data['april'];?>" name="april" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Mei</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['mei'];?>" name="mei" required>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-2 control-label">Juni</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['juni'];?>" name="juni" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Juli</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['juli'];?>" name="juli" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Agustus</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['agustus'];?>" name="agustus" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">September</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['september'];?>" name="september" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Oktober</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['oktober'];?>" name="oktober" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">November</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['november'];?>" name="november" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Desember</label>
                  <div class="col-sm-6">
                    <input type="number" class="form-control" value="<?php echo $data['desember'];?>" name="desember" required>
                  </div>
                </div>

              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-4"></div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
        
      </div>
    </div>
  </div> 
</section>


</div>
<?php }?>