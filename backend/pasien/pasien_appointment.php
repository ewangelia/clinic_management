<!-- <?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_appointment']))
		{
			$nama_pasien = $_POST['nama_user'];
			$nik_pasien = $_POST['nik'];
            $jk_pasien = $_POST['jk_user'];
            $pres_pat_addr = $_POST['pres_pat_addr'];
            $pres_pat_age = $_POST['pres_pat_age'];
           
            $pres_ins = $_POST['pres_ins'];
    
            //sql to insert captured values
			$query="INSERT INTO  antrean  (pres_pat_name, pres_pat_number, pres_pat_type, pres_pat_addr, pres_pat_age, pres_number, pres_pat_ailment, pres_ins) VALUES(?,?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssssss', $pres_pat_name, $pres_pat_number, $pres_pat_type, $pres_pat_addr, $pres_pat_age, $pres_number, $pres_pat_ailment, $pres_ins);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Patient Prescription Addded";
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
                $pat_number = $_GET['pat_number'];
                $ret="SELECT  * FROM his_patients WHERE pat_number=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$pat_number);
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
                                                <li class="breadcrumb-item"><a href="his_doc_dashboard.php">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Periksa</a></li>
                                                <li class="breadcrumb-item active">Buat Antrean</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Buat antrean sekarang!</h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title --> 
                            <!-- Form row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">FORM PERIKSA</h4>
                                            <!--Add Patient Form-->
                                            <form method="post">
                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">Nama Pasien</label>
                                                        <input type="text" required="required" readonly name="pres_pat_name" value="<?php echo $row->pat_fname;?> <?php echo $row->pat_lname;?>" class="form-control" id="inputEmail4" >
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Usia</label>
                                                        <input required="required" type="text" readonly name="pres_pat_age" value="<?php echo $row->pat_age;?>" class="form-control"  id="inputPassword4" >
                                                    </div>

                                                

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail4" class="col-form-label">No. Telp</label>
                                                        <input type="text" required="required" readonly name="pres_pat_number" value="<?php echo $row->pat_number;?>" class="form-control" id="inputEmail4">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Alamat</label>
                                                        <input required="required" type="text" readonly name="pres_pat_addr" value="<?php echo $row->pat_addr;?>" class="form-control"  id="inputAdress4" >
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Jenis Kelamin</label>
                                                        <select id="inputState" required="required" name="doc_name" class="form-control">
                                                        <option >Pilih</option >
                                                        <option>P</option>
                                                        <option>L</option>
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label for="inputDoctor" class="col-form-label">Dokter</label>
                                                    <select id="doctor" required="required" name="doc_name" class="form-control">
                                                        <option >Pilih</option >
                                                        <option>Dr. Aulia</option>
                                                        <option>Dr. Ananta</option>
                                                    </select>
                                                </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputDate" class="col-form-label">Tanggal </label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+2 day')); ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                    <label for="slot">Pilih Slot:</label>
                                                    <select name="slot" id="slot" class="form-control">
                                                        <?php for($i = 1; $i <= 14; $i++) { ?>
                                                            <option value="<?php echo $i; ?>"> <?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                    
                                                    
                                                <hr>
                            

                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Keluhan</label>
                                                        <textarea required="required"  type="text" class="form-control" name="pres_ins" id="editor"></textarea>
                                                </div>

                                                <button type="submit" name="add_appointment" class="ladda-button btn btn-primary" data-style="expand-right"> SUBMIT</button>

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
            <?php }?>

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

</html> -->