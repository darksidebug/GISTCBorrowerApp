<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    if($this->session->userdata('logged_in') == false){
        redirect('pages/login/');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GISTC Borrower App</title>
    <link rel="icon" href="<?php echo base_url('assets/img/Ojt-ID_BACK.jpg'); ?>">
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('node_modules/bootswatch/dist/flatly/bootstrap.css'); ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/main_style.css'); ?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/service.css'); ?>"> -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/sweetalert/dist/sweetalert.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('src/datatables/css/dataTables.bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('src/datatables/css/jquery.dataTables.min.css'); ?>">
    <script src="<?php echo base_url('src/sweetalert/dist/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/sweetalert/dist/sweetalert-dev.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/script/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/script/js/bootstrap.min.js'); ?>"></script>
    <!-- <script src="<?php echo base_url('src/script/jquery/my_js.js'); ?>"></script> -->
    <script src="<?php echo base_url('src/datatables/js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('src/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>
</head>
<body>
    <div id="myNavbar" class="navbar navbar-default navbar-fixed-top top__wrapper" role="navigation">
        <div class="top_logo">
            <div class="container logo">
                <h5> GIS</h5>
            </div>
        </div>
        <div class="container bar">  
            <a href="#" class='navbar-brand'>GISTC Borrower App</a>
            <ul class="nav navbar-nav navbar-left items">
                <?php
                    if($this->session->userdata('position') == 'Director' || $this->session->userdata('position') == 'Admin'){
                        ?>
                            <li><a href="<?php echo base_url('pages/main/admin/approval/pending'); ?>">MAIN PAGE</a></li>
                        <?php
                    }
                    if($this->session->userdata('position') == 'Clerk'){
                        ?>
                            <li><a href="<?php echo base_url('pages/main/main_page/Equipment/Document/not_returned'); ?>">MAIN PAGE</a></li>
                        <?php
                    }
                ?>
                
                <li><a href="<?php echo base_url('pages/borrow/'); ?>">BORROW</a></li>
                <!-- <li><a href="<?php echo base_url('pages/return/'); ?>">RETURN</a></li> -->
                <!-- <li><a href="#">REPORTS</a></li> -->
            </ul>
            <div class="navbar-right" id="align" align="right">
                <a href="<?php echo base_url('pages/register/'); ?>" class="btn btn__reg"><i class="fa fa-edit"></i>&nbsp;REGISTER</a>
                <a href="<?php echo base_url('user/logout/'); ?>" class="btn btn__logout"><i class="fa fa-power-off"></i>&nbsp;LOGOUT</a>
            </div>
        </div>
    </div>