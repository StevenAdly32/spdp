<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPDP (Daftar SPDP)</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php include "header.php"; ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php include "menu.php"; ?>

<?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../index.php"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>
<?php } ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SPDP
            <small>SISTEM REMINDER PERKARA</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Daftar SPDP</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">

              <!-- TO DO List -->
              <div class="box box-primary">
                <div class="box-header">
                  <i class="ion ion-clipboard"></i>
                  <h3 class="box-title">Daftar SPDP</h3>
                  <div class="box-tools pull-right">
                  <form action='kontrak-karyawan.php' method="POST">
    	             <div class="input-group" style="width: 230px;">
                      <input type="text" name="qcari" class="form-control input-sm pull-right" placeholder="Cari Nama">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-default tooltips" data-placement="bottom" data-toggle="tooltip" title="Cari Data"><i class="fa fa-search"></i></button>
                        <a href="kontrak-karyawan.php" class="btn btn-sm btn-success tooltips" data-placement="bottom" data-toggle="tooltip" title="Refresh"><i class="fa fa-spin fa-refresh"></i></a>
                      </div>
                    </div>
                    </form>
                  </div> 
                </div><!-- /.box-header -->
                
                <div class="box-body">
                <?php
					$date = date('Y-m-d');
                    //$date1= date_add($date, date_interval_create_from_date_string('10 days'));
					$kontrak = "kontrak";
					
					$query1="SELECT *,DATE_ADD(k1_finish, INTERVAL -30 DAY) as kontrak_habis, DATEDIFF(DATE_ADD(k1_finish, INTERVAL 0 DAY), CURDATE()) as selisih, DATEDIFF(DATE_ADD(k2_finish, INTERVAL 0 DAY), CURDATE()) as selisih1 FROM karyawan WHERE DATEDIFF(DATE_ADD(k1_finish, INTERVAL 0 DAY), CURDATE()) >= '1' AND DATEDIFF(DATE_ADD(k1_finish, INTERVAL 0 DAY), CURDATE()) <= '30' or DATEDIFF(DATE_ADD(k2_finish, INTERVAL 0 DAY), CURDATE()) >= '1' AND DATEDIFF(DATE_ADD(k2_finish, INTERVAL 0 DAY), CURDATE()) <= '30'";
                    
                   /** if(isset($_POST['qcari'])){
	               $qcari=$_POST['qcari'];
	               $query1="SELECT *,DATE_ADD(k1_finish, INTERVAL -30 DAY) as kontrak_habis, DATEDIFF(DATE_ADD(k1_finish, INTERVAL -30 DAY), CURDATE()) as selisih FROM karyawan WHERE nama like '%$qcari%' AND status like '%$kontrak%'";
                    
                    }**/
                    $tampil=mysqli_query($koneksi, $query1) or die(mysqli_error());
                    ?>
                  <table id="example" class="table table-hover table-bordered">
                  <thead>
                      <tr>
                        <th><center>No </i></center></th>
                        <th><center>Nama Tersangka</center></th>
						<th><center>No. SPDP</center></th>
						<th><center>Tanggal SPDP</center></th>
						<th><center>Tanggal Terima SPDP</center></th>
						<th><center>Asal SPDP</center></th>
                        <th><center>Pasal SPDP</center></th>
						<th><center>Jaksa Penuntut Umum Ke - I</center></th>
						<th><center>Jaksa Penuntut Umum Ke - II</center></th>
                        <th><center>Batas Waktu</center></th>
						<th><center>Status</center></th>
						
                      </tr>
                  </thead>
                     <?php 
                     $no=1;
                     while($data=mysqli_fetch_array($tampil))
                    { //$no++; ?>
                    <tbody>
                    <tr>
					<td><center><?php echo $no;$no++;?></center></td>
                     <td><center><?php echo $data['nama'];?></center></td>
                    <td><center><?php echo $data['bagian'];?></center></td>
					<td><?php echo date('d-m-Y', strtotime($data["k1_join"]));   ?></td>
					<td><?php echo date('d-m-Y', strtotime($data["k2_join"]));   ?></td>
					<td><center><?php echo $data['nik'];?></center></td>
					<td><center><?php echo $data['k1_finish']; ?><center/></td>
                    <td><center><?php
                            if($data['jpu'] == 'MUHAMMAD ALI AKHBAR, S.H, M.H'){
								echo '<span >MUHAMMAD ALI AKHBAR, S.H, M.H</</span>';
							}
                            else if ($data['jpu'] == 'SYAHRIL, SH, MH' ){
								echo '<span >SYAHRIL, SH, MH</span>';
							}
                            else if ($data['jpu'] == 'MIFTAHUDDIN, SH' ){
								echo '<span >MIFTAHUDDIN, SH</span>';
							}
							else if ($data['jpu'] == 'DARMAWAN HAMZAH SIREGAR, SH' ){
								echo '<span >DARMAWAN HAMZAH SIREGAR, SH</span>';
							}
							else if ($data['jpu'] == 'FAKHRILLAH, SH, MH' ){
								echo '<span >FAKHRILLAH, SH, MH</span>';
							}
							else if ($data['jpu'] == 'Dr. FERRY ICHSAN KARUNIA, SH, MH' ){
								echo '<span >Dr. FERRY ICHSAN KARUNIA, SH, MH</span>';
							}
							else if ($data['jpu'] == 'MARZA, SH' ){
								echo '<span >MARZA, SH</span>';
							}
							else if ($data['jpu'] == 'AL MUHAJIR, SH' ){
								echo '<span >AL MUHAJIR, SH</span>';
							}
                            else if ($data['jpu'] == 'MUHAMMAD DONI SIDIK, SH' ){
								echo '<span >MUHAMMAD DONI SIDIK, SH</span>';
							}
                            else if ($data['jpu'] == 'outsource' ){
								echo '<span class="label label-warning">Outsourcing</span>';
							}
                    
                    ?></center></td>
					<td><center><?php
                            if($data['jpuu'] == 'MUHAMMAD ALI AKHBAR, S.H, M.H'){
								echo '<span >MUHAMMAD ALI AKHBAR, S.H, M.H</</span>';
							}
                            else if ($data['jpuu'] == 'SYAHRIL, SH, MH' ){
								echo '<span >SYAHRIL, SH, MH</span>';
							}
                            else if ($data['jpuu'] == 'MIFTAHUDDIN, SH' ){
								echo '<span >MIFTAHUDDIN, SH</span>';
							}
							else if ($data['jpuu'] == 'DARMAWAN HAMZAH SIREGAR, SH' ){
								echo '<span >DARMAWAN HAMZAH SIREGAR, SH</span>';
							}
							else if ($data['jpuu'] == 'FAKHRILLAH, SH, MH' ){
								echo '<span >FAKHRILLAH, SH, MH</span>';
							}
							else if ($data['jpuu'] == 'Dr. FERRY ICHSAN KARUNIA, SH, MH' ){
								echo '<span >Dr. FERRY ICHSAN KARUNIA, SH, MH</span>';
							}
							else if ($data['jpuu'] == 'MARZA, SH' ){
								echo '<span >MARZA, SH</span>';
							}
							else if ($data['jpuu'] == 'AL MUHAJIR, SH' ){
								echo '<span >AL MUHAJIR, SH</span>';
							}
                            else if ($data['jpuu'] == 'MUHAMMAD DONI SIDIK, SH' ){
								echo '<span >MUHAMMAD DONI SIDIK, SH</span>';
							}
                            else if ($data['jpuu'] == 'outsource' ){
								echo '<span class="label label-warning">Outsourcing</span>';
							}
                    
                    ?></center></td>
                            <td><center><b style="color: red;"><?php if($data['selisih1'] ==0 ){
								//echo $data['selisih1'];
                                echo 'Tidak Ada';
							}
                            else if ($data['selisih1'] >= 1 ){
								echo $data['selisih1'];
                                echo '    hari lagi';                                
							}
                            else if ($data['selisih'] <= 1){
                                echo '<b style="color: blue;">Tidak Ada</b>';                                
							}
                             ?></b></center></td>
                    <td><center><?php
                            if($data['status'] == 'Berkas Pekara'){
								echo '<span class="label label-success">Berkas Pekara</span>';
							}
                            else if ($data['status'] == 'P-17' ){
								echo '<span class="label label-primary">P-17</span>';
							}
                            else if ($data['status'] == 'P-19' ){
								echo '<span class="label label-primary">P-19</span>';
							}
                            else if ($data['status'] == 'P-20' ){
								echo '<span class="label label-info">P-20</span>';
							}
							else if ($data['status'] == 'P-21' ){
								echo '<span class="label label-info">P-21</span>';
							}
							else if ($data['status'] == 'Tahap II' ){
								echo '<span class="label label-info">Tahap II</span>';
							}
							else if ($data['status'] == 'Pelimpahan' ){
								echo '<span class="label label-info">Pelimpahan</span>';
							}
							else if ($data['status'] == 'Sikap Putusan' ){
								echo '<span class="label label-info">Sikap Putusan</span>';
							}
                            else if ($data['status'] == 'outsource' ){
								echo '<span class="label label-warning">Outsourcing</span>';
							}
                    
                    ?></center></td>
                    </tr> <?php   
              } 
              ?>
                   </tbody>
                   </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </section><!-- /.Left col -->
          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?php include "footer.php"; ?>

      <?php include "sidecontrol.php"; ?>
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
  </body>
</html>
