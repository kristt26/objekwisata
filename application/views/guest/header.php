<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title?></title>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">




</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container" id="navbar">
      <div class="navbar-header">
        <a href="#" class="navbar-brand navbar-link">wisata</a>
        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      </div>
      <div class="collapse navbar-collapse" id="navcol-1">
        <ul class="nav navbar-nav navbar-right">
          <li role="presentation"><a href="<?= base_url()?>home">Home</a></li>
          <li role="presentation"><a href="<?= base_url()?>guest/event">Event</a></li>
          <li role="presentation"><a href="<?= base_url()?>guest/wisata">Wisata</a></li>
          <li role="presentation"><a href="<?= base_url()?>guest/bukutamu">Buku Tamu</a></li>
          <?php if($a = $this->session->userdata('user_data')){?>
            <li role="presentation"><a href="<?= base_url()?>auth/logout">Logout</a></li>
          <?php }else{ ?>
            <li role="presentation"><a href="<?= base_url()?>auth">Login</a></li>
          <?php }?>
        </ul>
      </div>
    </div>
  </nav>