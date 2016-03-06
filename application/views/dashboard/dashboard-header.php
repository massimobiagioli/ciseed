<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ciseed</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/jqueryui/themes/redmond/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/jqueryui/themes/redmond/theme.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/primeui/primeui-min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/fontawesome/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/theme/css/fonts.css">
        
        <!-- Scripts -->
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>        
        <script src="<?php echo base_url(); ?>assets/bower_components/jqueryui/jquery-ui.min.js"></script>        
        <script src="<?php echo base_url(); ?>assets/bower_components/primeui/primeui-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>       
        
        <!-- App -->
        <script src="<?php echo base_url(); ?>assets/app/js/app.js"></script>       
        
        <!-- Custom -->
        <?php $this->load->view($customHeader); ?>        
    </head>