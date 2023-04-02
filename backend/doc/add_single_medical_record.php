<!--Server side code untuk add medical record-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_mr']))
		{
			$id_pasien = $_POST['id_data_user'];
			$id_periksa = $_POST['id_periksa'];
            $keluhan_pasien = $_POST['keluhan_pasien'];
            $diagnosa = $_POST['diagnosa'];
            $tindakan=$_POST['tindakan']
            $resep_obat=$_POST['resep_obat']
            //sql to insert captured values
			$query="INSERT INTO  rekam_medis (id_data_user,id_periksa, keluhan_pasien,diagnosa, tindakan, resep_obat) VALUES(?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssss', $id_pasien, $id_periksa, $keluhan_pasien ,  $diagnosa, $tindakan, $resep_obat);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Patient Medical Record Addded";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
<!--End Patient Registration-->
<!DOCTYPE html>
<html lang="en">
    
    <!--Head-->
    <?php include('assets/inc/head.php');?>
    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include("assets/inc/nav.php");?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <?php
                $nik_pasien = $_GET['nik'];
                $ret="SELECT  * FROM users WHERE nik=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$nik);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
            ?>
                <div class="content-page">
                    <div class="content">

                        <!-- Start Content-->
                        <div class="container-fluid">
                            
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <div class="page-title-right">
                                            <ol class="breadcrumb m-0">
                                                <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Rekam Medis</a></li>
                                                <li class="breadcrumb-item active">Tambah Rekam Medis</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Tambah Rekam Medis</h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title --> 
                            <!-- Form row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Isi semua kolom</h4>
                                            <!--Add Patient Form-->
                                            <form method="post">
                                                <div class="form-row">

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail4" class="col-form-label">Nama Pasien</label>
                                                        <input type="text" required="required" readonly name="nama_user" value="<?php echo $row->nama_user;?> " class="form-control" id="inputEmail4" placeholder="Patient's Name">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Tanggal Lahir Pasien</label>
                                                        <input required="required" type="text" readonly name="ttl_user" value="<?php echo $row->ttl_user;?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Alamat Pasien</label>
                                                        <input required="required" type="text" readonly name="alamat_user" value="<?php echo $row->alamat_user;?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Last Name">
                                                    </div>

                                                </div>

                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">NIK</label>
                                                        <input type="text" required="required" readonly name="nik" value="<?php echo $row->nik;?>" class="form-control" id="inputEmail4" >
                                                    </div>
                                                    </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Keluhan</label>
                                                        <input required="required" type="text"  name="diagnosa" value="<?php echo $row->diagnosa;?>" class="form-control"  id="inputPassword4" >
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Diagnosa</label>
                                                        <input required="required" type="text"  name="diagnosa" value="<?php echo $row->diagnosa;?>" class="form-control"  id="inputPassword4" >
                                                    </div>
                                                    
                                                </div>
                                                <?php }?>
                                                <hr>
                                                <!-- <div class="form-row">
                                                    
                                            
                                                    <div class="form-group col-md-2" style="display:none">
                                                        <?php 
                                                            $length = 5;    
                                                            $pres_no =  substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,$length);
                                                        ?>
                                                        <label for="inputZip" class="col-form-label">Medical Record Number</label>
                                                        <input type="text" name="no_user" value="<?php echo $pres_no;?>" class="form-control" id="inputZip">
                                                    </div>
                                                </div> -->
                                                <?php
                                                    $nik_pasien = $_GET['nik'];
                                                    $ret="SELECT  * FROM rekam_medis WHERE nik = ?";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->bind_param('s',$pres_pat_number);
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                ?>
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Resep Obat Pasien</label>
                                                        <textarea required="required"  type="text" class="form-control" name="resep_obat" id="editor"><?php echo $row->resep_obat;?> </textarea>
                                                </div>
                                                <?php }?>

                                                <button type="submit" name="add_mr" class="ladda-button btn btn-primary" data-style="expand-right">Tambah Rekam Medis</button>

                                            </form>
                                            <!--End Patient Form-->
                                        </div> <!-- end card-body -->
                                    </div> <!-- end card-->
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->

                        </div> <!-- container -->

                    </div> <!-- content -->

                    <!-- Footer Start -->
                    <?php include('assets/inc/footer.php');?>
                    <!-- end Footer -->

                </div>
            

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

       
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
        <script type="text/javascript">
        CKEDITOR.replace('editor')
        </script>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>