      </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.18
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
      reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 3 -->

  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url();?>assets/bower_components/angular/angular.min.js"></script>
  <script src="<?php echo base_url();?>assets/js/apps.js"></script>
  <script src="<?php echo base_url();?>assets/js/controller/admin.controller.js"></script>
  <script src="<?php echo base_url();?>assets/js/helper.services.js"></script>
  <script src="<?php echo base_url();?>assets/js/data.service.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url();?>assets/node_modules/angular-datatables/dist/angular-datatables.min.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url();?>assets/dist/js/adminlte.min.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
  <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- SlimScroll -->
  <script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <script src="<?php echo base_url();?>assets/node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/ckeditor/ckeditor.js"></script>
  <script src="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/input-mask/angular-input-masks-standalone.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/angular-locale-id.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/bower_components/jquery-loading-overlay/dist/loadingoverlay.min.js"></script>



  <!-- <script src="<?php echo base_url();?>assets/dist/js/pages/dashboard2.js"></script> -->
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
  <script src="<?php echo base_url();?>assets/js/googleMap.js"></script>
  <script src="<?php echo base_url();?>assets/js/script.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo&libraries=geometry,places"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script>
  $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fas fa-cog fa-spin"
    });
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
    $(document).ready(function(){
        // get Edit Product
        $('.btn-edit').on('click',function(){
            // get data from button edit
            const nama = $(this).data('nama');
            const idkategori = $(this).data('idkategori');
            // Set data to Form Edit
            $('.edit-nama').val(nama);
            $('.edit-kategori').val(idkategori);
            // Call Modal Edit
            $('#edit-data').modal('show');
        });
 
        // get Delete Product
        $('.btn-delete').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.productID').val(id);
            // Call Modal Edit
            $('#deleteModal').modal('show');
        });
    });
</script>
</body>

</html>