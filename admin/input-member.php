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
    <title>SPDP (Input SPDP)</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../css/ionicons.min.css">
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
            <li class="active">Input SPDP</li>
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
                  <h3 class="box-title">Input Data SPDP</h3>
                  <div class="box-tools pull-right">
                  <!-- <form action='admin.php' method="POST">
    	             <div class="input-group" style="width: 230px;">
                      <input type="text" name="qcari" class="form-control input-sm pull-right" placeholder="Cari Usename Atau Nama">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-default tooltips" data-placement="bottom" data-toggle="tooltip" title="Cari Data"><i class="fa fa-search"></i></button>
                        <a href="admin.php" class="btn btn-sm btn-success tooltips" data-placement="bottom" data-toggle="tooltip" title="Refresh"><i class="fa fa-refresh"></i></a>
                      </div>
                    </div>
                    </form> -->
                  </div> 
                </div><!-- /.box-header -->
                <?php
		/**	if(isset($_POST['input'])){
				$nik	    = $_POST['nik'];
				$nama       = $_POST['nama'];
				$bagian     = $_POST['bagian'];
				$k1_join    = $_POST['k1_join'];
				$k1_finish  = $_POST['k1_finish'];
                $k2_join    = $_POST['k2_join'];
				$k2_finish  = $_POST['k2_finish']; 
   	            $status     = $_POST['status'];
				$jpu     	= $_POST['jpu'];
				$jpuu     	= $_POST['jpuu'];
				
                
				$cek = mysqli_query($koneksi, "SELECT * FROM karyawan WHERE nik='$nik'");
				if(mysqli_num_rows($cek) == 0){
						$insert = mysqli_query($koneksi, "INSERT INTO karyawan(nik, nama, bagian, k1_join, k1_finish, k2_join, k2_finish, status, jpu, jpuu)
															VALUES('$nik','$nama','$bagian','$k1_join','$k1_finish','$k2_join','$k2_finish','$status','$jpu','$jpuu')") or die(mysqli_error());
						if($insert){
							echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data Karyawan Berhasil Di Simpan.</div>';
						}else{
							echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Ups, Data Karyawan Gagal Di simpan !</div>';
						}
				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Member Sudah Ada..!</div>';
				}
			} **/
            
            if(isset($_POST['input'])){
$namafolder="foto_member/"; //tempat menyimpan file

if (!empty($_FILES["nama_file"]["tmp_name"]))
{
	$jenis_gambar=$_FILES['nama_file']['type'];
                $nik	    = $_POST['nik'];
				$nama       = $_POST['nama'];
				$bagian     = $_POST['bagian'];
				$k1_join    = $_POST['k1_join'];
				$k1_finish  = $_POST['k1_finish'];
                $k2_join    = $_POST['k2_join'];
				$k2_finish  = $_POST['k2_finish']; 
   	            $status     = $_POST['status'];
				$jpu     	= $_POST['jpu'];
				$jpuu     	= $_POST['jpuu'];
        
        /**$cekno= mysqli_query($koneksi, "SELECT * FROM produk ORDER BY kd_produk DESC");
        
        
        $data1=mysqli_num_rows($cekno);
        $cekQ1=$data1;
        //$data=mysqli_fetch_array($ceknomor);
        //$cekQ=$data['f_kodepart'];
        #menghilangkan huruf
        //$awalQ=substr($cekQ,0-6);
        #ketemu angka awal(angka sebelumnya) + dengan 1
        $next1=$cekQ1+1;

        #menhitung jumlah karakter
        $kode1=strlen($next1);
        $p = "P";
        if(!$cekQ1)
        { $no1='000001'; }
        elseif($kode1==1)
        { $no1='00000'; }
        elseif($kode1==2)
        { $n1o='0000'; }
        elseif($kode1==3)
        { $no1='000'; }
        elseif($kode1==4)
        { $no1='00'; }
        elseif($kode1==5)
        { $no1='0'; }
        elseif($kode1=6)
        { $no=''; }

        // masukkan dalam tabel penjualan
        $kode=$p.$no1.$next1;**/
		
	if($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif" || $jenis_gambar=="image/x-png")
	{			
		$gambar = $namafolder . basename($_FILES['nama_file']['name']);		
		if (move_uploaded_file($_FILES['nama_file']['tmp_name'], $gambar)) {
			$sql="INSERT INTO karyawan(nik, nama, bagian, k1_join, k1_finish, k2_join, k2_finish, status, jpu, jpuu, gambar) VALUES
                                      ('$nik','$nama','$bagian','$k1_join','$k1_finish','$k2_join','$k2_finish','$status','$jpu','$jpuu','$gambar')";
			$res=mysqli_query($koneksi, $sql) or die (mysqli_error());
			//echo "Gambar berhasil dikirim ke direktori".$gambar;
            echo "<script>alert('Data karyawan berhasil dimasukan!'); window.location = 'member.php'</script>";	   
		} else {
		   echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>Gambar gagal dikirim</p></div>';
		}
   } else {
		echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Jenis gambar yang anda kirim salah. Harus .jpg .gif .png</div>';
   }
} else {
	echo '<div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Anda Belum Memilih Gambar</div>';
}
}
			?>
                <div class="box-body">
                <form class="form-horizontal style-form" action="input-member.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Asal SPDP</label>
                              <div class="col-sm-4">
                                  <input name="nik" type="text" id="nik" class="form-control" placeholder="Asal SPDP" autocomplete="off" autofocus="on" required="required" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                              <div class="col-sm-4">
                            <input name="nama" type="text" id="nama" class="form-control" placeholder="Nama Tersangka" autocomplete="off" required />
                              
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">No SPDP</label>
                              <div class="col-sm-4">
                            <input name="bagian" type="text" id="bagian" class="form-control" placeholder="No SPDP" autocomplete="off" required />
                              
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal SPDP</label>
                              <div class="col-sm-4">
                            <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='k1_join' id="tanggal_beli" placeholder='Tanggal SPDP' required />
                            
                            </div>
                          </div>
						  <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Pasal SPDP</label>
                              <div class="col-sm-4">
                            <input name="k1_finish" type="text" id="k1_finish" class="form-control" placeholder="Pasal SPDP" autocomplete="off" required />
                              
                            </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tanggal Terima SPDP</label>
                              <div class="col-sm-4">
                            <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='k2_join' id="tanggal_beli" placeholder='Tanggal Terima SPDP' required />
                            
                            </div>
                          </div>
                           <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Batas Waktu</label>
                              <div class="col-sm-4">
                            <input type='text' class="input-group date form-control" data-date="" data-date-format="yyyy-mm-dd" name='k2_finish' id="tanggal_beli" placeholder='Batas Waktu' required />
                            
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                            <select id="status" name="status" class="form-control" required>
                            <option value="">-- Pilih Status --</option>
							<option value="Berkas Pekara">Berkas Pekara</option>
                            <option value="P-17">P-17</option>
                            <option value="P-19">P-19</option> 
                            <option value="P-20">P-20</option> 
							<option value="P-21">P-21</option>
							<option value="Tahap II">Tahap II</option>
							<option value="Pelimpahan">Pelimpahan</option>
							<option value="Sikap Putusan">Sikap Putusan</option> 
                            </select>  
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">JPU</label>
                              <div class="col-sm-4">
                            <select id="jpu" name="jpu" class="form-control" required>
                            <option value="">-- Pilih JPU 1 --</option>
							<option value="MUHAMMAD ALI AKHBAR, S.H, M.H">MUHAMMAD ALI AKHBAR, S.H, M.H</option>
                            <option value="SYAHRIL, SH, MH">SYAHRIL, SH, MH</option>
                            <option value="MIFTAHUDDIN, SH">MIFTAHUDDIN, SH</option> 
                            <option value="DARMAWAN HAMZAH SIREGAR, SH">DARMAWAN HAMZAH SIREGAR, SH</option> 
							<option value="FAKHRILLAH, SH, MH">FAKHRILLAH, SH, MH</option>
							<option value="Dr. FERRY ICHSAN KARUNIA, SH, MH">Dr. FERRY ICHSAN KARUNIA, SH, MH</option>
							<option value="MARZA, SH">MARZA, SH</option>
							<option value="AL MUHAJIR, SH">AL MUHAJIR, SH</option>
							<option value="MUHAMMAD DONI SIDIK, SH">MUHAMMAD DONI SIDIK, SH</option>
                            </select>  
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">JPU</label>
                              <div class="col-sm-4">
                            <select id="jpuu" name="jpuu" class="form-control" required>
                            <option value="">-- Pilih JPU II --</option>
							<option value="MUHAMMAD ALI AKHBAR, S.H, M.H">MUHAMMAD ALI AKHBAR, S.H, M.H</option>
                            <option value="SYAHRIL, SH, MH">SYAHRIL, SH, MH</option>
                            <option value="MIFTAHUDDIN, SH">MIFTAHUDDIN, SH</option> 
                            <option value="DARMAWAN HAMZAH SIREGAR, SH">DARMAWAN HAMZAH SIREGAR, SH</option> 
							<option value="FAKHRILLAH, SH, MH">FAKHRILLAH, SH, MH</option>
							<option value="Dr. FERRY ICHSAN KARUNIA, SH, MH">Dr. FERRY ICHSAN KARUNIA, SH, MH</option>
							<option value="MARZA, SH">MARZA, SH</option>
							<option value="AL MUHAJIR, SH">AL MUHAJIR, SH</option>
							<option value="MUHAMMAD DONI SIDIK, SH">MUHAMMAD DONI SIDIK, SH</option>
                            </select>  
                            </div>
                          </div>				  
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Foto</label>
                              <div class="col-sm-8">
                            <input name="nama_file" type="file" id="nama_file" class="form-control" placeholder="Pilih Gambar Produk" autocomplete="off" required />
                              
                            </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" name="input" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="member.php" class="btn btn-sm btn-danger">Batal </a>
                              </div> 
                          </div>
                      </form>
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
    <script src="../css/jquery-ui.min.js"></script>
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
    <script>
	//options method for call datepicker
	$(".input-group.date").datepicker({ autoclose: true, todayHighlight: true });
	
    </script>
  </body>
</html>
