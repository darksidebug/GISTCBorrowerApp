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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/Fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/main_style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/sweetalert/dist/sweetalert.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('src/datatables/css/dataTables.bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('src/datatables/css/jquery.dataTables.min.css'); ?>">
    <script src="<?php echo base_url('src/sweetalert/dist/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/script/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/script/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/datatables/js/jquery.dataTables1.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/datatables/js/dataTables.bootstrap.min.js'); ?>"></script>

    <!-- print, copy, csv, excel, pdf -->
    <link rel="stylesheet" href="<?php echo base_url('src/datatables/css/buttons.dataTables.min.css'); ?>">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>

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
                            <li><a href="<?php echo base_url('pages/admin/approval/Equipment/Document/not_returned/pending'); ?>">MAIN PAGE</a></li>
                        <?php
                    }
                    if($this->session->userdata('position') == 'Clerk'){
                        ?>
                            <li><a href="<?php echo base_url('pages/main/main_page/Equipment/Document/'); ?>">MAIN PAGE</a></li>
                        <?php
                    }
                ?>
                <li><a href="<?php echo base_url('pages/borrow/'); ?>">BORROW</a></li>
                <li><a href="<?php echo base_url('pages/reports/display_details/'); ?>">REPORTS</a></li>
            </ul>
            <div class="navbar-right" id="align" align="right">
                <a href="<?php echo base_url('pages/register/'); ?>" class="btn btn__reg"><i class="fa fa-edit"></i>&nbsp;REGISTER</a>
                <a href="<?php echo base_url('user/logout/'); ?>" class="btn btn__logout"><i class="fa fa-power-off"></i>&nbsp;LOGOUT</a>
            </div>
        </div>
    </div>