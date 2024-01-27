<?php if(empty($connection)){
  header('location:./404');
} else {

echo'<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <div class="slimScrollDiv">
    <section class="sidebar">
      <!-- Sidebar user panel -->
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MENU UTAMA</li>';
      if($mod =='home'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./"><i class="fa fa-home"></i><span>Dashboard</span></a></li>';
      
      if($mod =='karyawan' OR $mod=='jabatan' OR $mod=='shift' OR $mod=='lokasi'){echo'<li class="active treeview">'; }else{
      echo'<li class="treeview">';}
      echo'
          <a href="#">
            <i class="fa fa-database"></i> <span>Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';
            if($mod =='karyawan'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./karyawan"><i class="fa fa-circle-o"></i> Data Pengguna</a></li>';
            if($mod =='jabatan'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./jabatan"><i class="fa fa-circle-o"></i> Data Jabatan</a></li>';
            if($mod =='shift'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="shift"><i class="fa fa-circle-o"></i> Data Jam Kerja</a></li>';
            if($mod =='lokasi'){echo'<li class="active">'; }else{echo'<li>';}
             echo'<a href="./lokasi"><i class="fa fa-circle-o"></i> Data Lokasi</a></li>
          </ul>
        </li>';

      if($mod =='absensi'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./absensi"><i class="fa fa-list-alt" aria-hidden="true"></i> <span>Data Absensi</span></a></li>';

      if($mod =='absensi'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./setting"><i class="fa fa-file-text" aria-hidden="true"></i> <span>Data Laporan</span></a></li>';

      if($mod =='kpi' OR $mod=='target'){echo'<li class="active treeview">'; }else{
        echo'<li class="treeview">';}
        echo'
            <a href="#">
              <i class="fa fa fa-file-text"></i> <span>Data KPI</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">';
              if($mod =='target'){echo'<li class="active">'; }else{echo'<li>';}
               echo'<a href="./target"><i class="fa fa-circle-o"></i> Target Penilaian</a></li>';
              if($mod =='laporankpi'){echo'<li class="active">'; }else{echo'<li>';}
               echo'<a href="./laporankpi"><i class="fa fa-circle-o"></i> Laporan KPI</a></li>
              </ul>
          </li>'; 

      if($mod =='user'){echo'<li class="active">'; }else{echo'<li>';}
      echo'<a href="./user"><i class="fa fa-user"></i> <span>Administrator</span></a></li>';?>
      <li><a href="javascript:void();" onClick="location.href='./logout';"><i class="fa fa-sign-out"></i>  <span>Keluar</span></a></li>
  <?php echo'
      </ul>
    </section>
  </div>
    <!-- /.sidebar -->
  </aside>';
  }?>