<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();

  $id_user=$_SESSION['id_user'];
//   $nik = $_SERVER['nik'];
?>

<!DOCTYPE html>
    <html lang="en">

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

            <!--Get Details Of A Single User And Display Them Here-->
            <?php
                $nik=$_GET['nik'];
                $id_user=$_GET['id_user'];
                $level_user=$_GET['level_user'];
                $ret="SELECT  * FROM users WHERE id_user=? ";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$id_user);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
              
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">View Patients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $row->nama_user;?> 's Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="assets/images/users/patient.png" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                    
                                    <div class="text-left mt-3">
                                        
                                        <p class="text-muted mb-2 font-13"><strong>Nama :</strong> <span class="ml-2"><?php echo $row->nama_user;?> </span></p>
                                        <p class="text-muted mb-2 font-13"><strong>No Telp :</strong><span class="ml-2"><?php echo $row->no_telp_user;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Alamat :</strong> <span class="ml-2"><?php echo $row->alamat_user;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>TTL :</strong> <span class="ml-2"><?php echo $row->ttl_user;?></span></p>
                                        <!-- <p class="text-muted mb-2 font-13"><strong>Age :</strong> <span class="ml-2"><?php echo $row->pat_age;?> Years</span></p> -->
                                        <!-- <p class="text-muted mb-2 font-13"><strong>Diagnosa :</strong> <span class="ml-2"><?php echo $row->diagnosa;?></span></p> -->
                                        <hr>
                                        <!-- <p class="text-muted mb-2 font-13"><strong>Date Recorded :</strong> <span class="ml-2"><?php echo date("d/m/Y - h:m", strtotime($mysqlDateTime));?></span></p>
                                        <hr> -->




                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col-->
                            
                            <?php }?>
                            <div class="col-lg-8 col-xl-8">
                                <div class="card-box">
                                    <ul class="nav nav-pills navtab-bg nav-justified">
                                        <li class="nav-item">
                                            <a href="#aboutme" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                Resep Obat
                                            </a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a href="#timeline" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                                 Vitals
                                            </a>
                                        </li> -->
                                        <li class="nav-item">
                                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                                Tindakan
                                            </a>
                                        </li>
                                    </ul>
                                    <!--Medical History-->
                                    <div class="tab-content">
                                        <div class="tab-pane show active" id="aboutme">
                                             <ul class="list-unstyled timeline-sm">
                                                <?php
                                                    $id_data_user =$_GET['id_user'];
                                                    $ret="SELECT  * FROM rekam_medis WHERE id_data_user = '$id_data_user'";
                                                    $stmt= $mysqli->prepare($ret) ;
                                        
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                
                                                    
                                                    while($row=$res->fetch_object())
                                                        {
                                                    $mysqlDateTime = $row->tgl_periksa; //trim timestamp to date

                                                ?>
                                                    <li class="timeline-sm-item">
                                                        <span class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($mysqlDateTime));?></span>
                                                        <h5 class="mt-0 mb-1"><?php echo $row->diagnosa;?></h5>
                                                        <p class="text-muted mt-2">
                                                            <?php echo $row->resep_obat;?>
                                                        </p>

                                                    </li>
                                                <?php }?>
                                            </ul>
                                           
                                        </div> <!-- end tab-pane -->
                                        <!-- end Prescription section content -->

                                        <!-- <div class="tab-pane show " id="timeline">
                                            <div class="table-responsive">
                                                <table class="table table-borderless mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Body Temperature</th>
                                                            <th>Heart Rate/Pulse</th>
                                                            <th>Respiratory Rate</th>
                                                            <th>Blood Pressure</th>
                                                            <th>Date Recorded</th>
                                                        </tr>
                                                    </thead>
                                                    <!-- <?php
                                                        $vit_pat_number =$_GET['pat_number'];
                                                        $ret="SELECT  * FROM his_vitals WHERE vit_pat_number = '$vit_pat_number'";
                                                        $stmt= $mysqli->prepare($ret) ;
                                                        // $stmt->bind_param('i',$vit_pat_number );
                                                        $stmt->execute() ;//ok
                                                        $res=$stmt->get_result();
                                                        //$cnt=1;
                                                        
                                                        while($row=$res->fetch_object())
                                                            {
                                                        $mysqlDateTime = $row->vit_daterec; //trim timestamp to date

                                                    ?> -->
                                                        
                                

                                        <div class="tab-pane" id="settings">
                                            <ul class="list-unstyled timeline-sm">
                                                <?php
                                                    $id_data_user =$_GET['id_user'];
                                                    $ret="SELECT  * FROM rekam_media WHERE  id_data_user  ='$id_data_user'";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    // $stmt->bind_param('i',$lab_pat_number);
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    //$cnt=1;
                                                    
                                                    while($row=$res->fetch_object())
                                                        {
                                                    $mysqlDateTime = $row->tgl_periksa; //trim timestamp to date

                                                ?>
                                                    <li class="timeline-sm-item">
                                                        <span class="timeline-sm-date"><?php echo date("Y-m-d", strtotime($mysqlDateTime));?></span>
                                                        <h3 class="mt-0 mb-1"><?php echo $row->diagnosa;?></h3>
                                                        <hr>
                                                        <h5>
                                                           Tindakan
                                                        </h5>
                                                        
                                                        <p class="text-muted mt-2">
                                                            <?php echo $row->tindakan;?>
                                                        </p>
                                                        <hr>
                                                        <!-- <h5>
                                                           Laboratory Results
                                                        </h5>
                                                        
                                                        <p class="text-muted mt-2">
                                                            <?php echo $row->lab_pat_results;?>
                                                        </p>
                                                        <hr> -->

                                                    </li>
                                                <?php }?>
                                            </ul>
                                        </div>
                                        </div>
                                        <!-- end lab records content-->

                                    </div> <!-- end tab-content -->
                                </div> <!-- end card-box-->

                            </div> <!-- end col -->
                        </div>
                        <!-- end row-->

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

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>


</html>