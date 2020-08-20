<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?=base_url();?>assets/node_modules/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/stylesadmin.css">
  <script src="<?php echo base_url(); ?>assets/bower_components/chart.js/dist/Chart.min.css"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/chart.js/dist/Chart.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/chart.js/dist/utils.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url();?>welcome" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="<?= base_url('assets/img/logo.png')?>" style="width:40px" alt=""><b>Dinas Pariwisata</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?= base_url();?>auth/logout" >Logout</i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image" style="color:white">
            <h4><?= $this->session->userdata('user_data')->nama;?></h4>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            <!-- <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
          </div>
          <div class="pull-left info">
            
          </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li class="active"><a href="<?php echo base_url();?>admin/home"><i class="fa fa-home"></i> <span>Home</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url();?>admin/kategori"><i class="fa fa-circle-o"></i> Kategori</a></li>
              <li><a href="<?php echo base_url();?>admin/user"><i class="fa fa-circle-o"></i> User</a></li>
            </ul>
          </li>
          <li><a href="<?php echo base_url();?>admin/wisata"><i class="fa fa-map-marker"></i> <span>Wisata</span></a></li>
          <li><a href="<?php echo base_url();?>admin/event"><i class="fa fa-calendar"></i> <span>Event</span></a></li>
          <li><a href="<?php echo base_url();?>admin/bukutamu"><i class="fa fa-book"></i> <span>Buku Tamu</span></a></li>
          <li><a href="<?php echo base_url();?>admin/marking"><i class="fa fa-map-marker"></i> <span>Marking</span></a></li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active"><?php echo $titledash; ?></li>
        </ol>
    </section>
    <section class="content">