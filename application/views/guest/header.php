<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title?></title>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.css">
  <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
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
          <li role="presentation"><a href="#about">About</a></li>
          <li role="presentation"><a href="<?= base_url()?>auth">Login</a></li>
          <!-- <li role="presentation"><a href="#"><i class="glyphicon glyphicon-search"></i></a></li> -->
        </ul>
      </div>
    </div>
  </nav>