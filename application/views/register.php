<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?=base_url();?>assets/img/logo.png">
  <title>Wisata Jayapura | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
  <div class="data-flush" data-flash="<?= $this->session->flashdata('pesan');?>"></div>
  <div class="register-box">
    <div class="register-logo">
      <a href="<?php echo base_url();?>assets/index2.html"><b>Wisata Papua</b></a>
    </div>

    <div class="register-box-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?php echo base_url();?>registration/register" method="post">
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="username" id="username" placeholder="User anda" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" name="nama" placeholder="Nama lengkap" required>
          <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <textarea type="text" class="form-control" name="alamat" placeholder="Alamat lengkap" required></textarea>
          <span class="glyphicon glyphicon-book form-control-feedback"></span>
        </div>
        
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <div class="radio">
            <label class="radio-inline">
              <input type="radio" name="jk" id="jk1" value="Pria" required> Pria
            </label>
            <label class="radio-inline">
              <input type="radio" name="jk" id="jk2" value="Wanita" required> Wanita
            </label>
          </div>
          <span class="glyphicon glyphicon-genderless form-control-feedback"></span>
        </div>
        <!-- <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Retype password" required>
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div> -->
        <div class="row">
          <div class="col-xs-4 pull-right">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Daftar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
          Facebook</a>
        <?= $login_button; ?>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
          Google+</a>
      </div> -->

      <a href="<?= base_url()?>Auth" class="text-center">Sudah punya akun</a>
    </div>
    <!-- /.form-box -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery 3 -->
  <script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/node_modules/sweetalert/dist/sweetalert.min.js"></script>

  <!-- iCheck -->
  <script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
  <!-- <script src="<?php echo base_url();?>assets/js/script.js"></script> -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/jquery-loading-overlay/dist/loadingoverlay.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
    $(function () {
      $(document).ready(function () {
        $('.btn-flat').on('click', function () {
          $.LoadingOverlay("show", {
              image       : "",
              fontawesome : "fas fa-cog fa-spin"
          });
        });
      })
    })
    // $(function () {
    //   $(document).ready(function () {
    //       var data = $('.data-flush').data('flash');
    //       console.log(data);
    //       if (data) {
    //           $.LoadingOverlay("hide");
    //           var a = data.split(',');
    //           if (a[1].replace(/\s/g, '') == 'success') {
    //               swal("Information!", a[0], "success");
    //           } else {
    //               swal("Information!", a[0], "error");
    //           }
    //       }
    //   })
    // })
  </script>
</body>

</html>