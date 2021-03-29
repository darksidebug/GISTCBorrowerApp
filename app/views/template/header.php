<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/css/service.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('src/sweetalert/dist/sweetalert.css'); ?>">
    <script src="<?php echo base_url('src/sweetalert/dist/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/sweetalert/dist/sweetalert-dev.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/script/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/script/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('src/script/jquery/my_js.js'); ?>"></script>
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
        
            <div class="navbar-right" id="align" align="right">
                <!-- <a href="<?php echo base_url('pages/register/'); ?>" class="btn btn__reg"><i class="fa fa-edit"></i>&nbsp;REGISTER</a> -->
                <a href="<?php echo base_url('/'); ?>" class="btn btn__login"><i class="fa fa-user-circle"></i>&nbsp;LOGIN PAGE</a>
            </div>
        </div>
    </div>
	