<?php if(empty($connection)){
	header('location:./404');
} else {

$mod = "home";$mod = htmlentities(@$_GET['mod']);
// Get number
function get_numbers() {
  for ($i = 1; $i <= 500; $i++) {yield $i;}
}
$result = get_numbers();
function convert($size){
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
}
echo'
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
    Redeveloped by <a href="https://mycoding.id" rel="dofollow" target="_blank">MC Project</a> - <a href="https://401xd.com" rel="dofollow" target="_blank">401XD Group</a>
    </div> <div style="display: none;"><a class="credits" href="https://s-widodo.com" rel="nofollow" target="_blank"></a></div>
     &copy;'.DATE('Y').' '.$site_name.'
  </footer>
</div>
<!-- wrapper -->
<script src="./assets/js/jquery-2.2.3.min.js"></script>
<script src="./assets/js/jquery-ui.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script src="./assets/js/jquery.slimscroll.min.js"></script>
<script src="./assets/js/adminlte.js"></script>
<script src="./assets/js/app.js"></script>
<script src="./assets/js/demo.js"></script>
<script src="./assets/js/sweetalert.min.js"></script>
<script src="./plugins/chart.js/Chart.min.js"></script>
<script src="./assets/js/simple-lightbox.min.js"></script>
<script src="./assets/js/validasi/jquery.validate.js"></script>
<script src="./assets/js/validasi/messages_id.js"></script>';
if($mod =='shift'){echo'
<script src="./assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="./assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>';
}

if($mod=='karyawan' OR $mod =='jabatan' OR $mod=='shift' OR $mod=='lokasi' OR $mod=='user' OR $mod=='absensi'){
echo'
<link rel="stylesheet" href="./assets/plugins/datatables/dataTables.bootstrap.css">
<script src="./assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/plugins/datatables/dataTables.bootstrap.min.js"></script>';
}
if($mod=='absensi'){
echo'
<script src="../mod/assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>';
}

if(file_exists('mod/'.$mod.'/scripts.js')){
echo'
  <script src="mod/'.$mod.'/scripts.js"></script>';
}
echo'
  <script type="text/javascript">
  	$(document).ready(function() {
  		$(".validate").validate();
  	});
    
    $(document).ready(function() {
      $(".validate2").validate();
    });
    $(document).on("click", ".access-failed", function(){ 
      swal({title:"Error!", text: "Anda tidak memiliki hak akses!", icon:"error",timer:2000,});  
    });
  </script>';?>
  </body>
</html>
<?PHP }?>

