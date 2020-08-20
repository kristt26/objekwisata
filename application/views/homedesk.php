<div ng-app="app" ng-controller="homeController">
  <div id="background">
    <div class="jumbotron">
      <h1>Jembatan Merah</h1>
      <!-- <p>Think BIG with a Bootstrap Jumbotron!</p> -->
    </div>
    <!-- <div class="jumbotron">
        <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
        <h1>INDONESIA</h1>
        <p><a href="#" class="btn btn-default" role="button">EXPLORE</a></p>
      </div> -->
  </div>
  <!-- jumbotron -->

  <!-- container atas -->
  <div id="gallery">
    <div class="container">
      <h1 style="margin-bottom: 25px; text-align: center;">Event Wisata</h1>
      <div class="row">
        <div ng-repeat="item in datas.event" class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <div class="thumbnail">
            <div style="margin-left:12px; margin-right:12px">
              <a href="<?= base_url()?>guest/wisata/readwisata/{{item.idwisata}}">
                <h4>{{item.nama | limitTo:20}} <span ng-if="item.nama.length>20">...</span></h4>
              </a>
              <img src="<?= base_url('assets/img/event/');?>{{item.foto}}" width="100%" height="150px" alt=""
                style="margin-bottom:10px">
              <p class="text-left">
                <a href="#" style="color: black;"><i class="fa fa-user"></i> &nbsp;
                  Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="color: black;"><i class="fa fa-calendar"></i> &nbsp;
                  {{convertdate(item.tgl_posting) | date: 'EEEE, dd MMM yyyy'}}</a>
              </p>
              <hr>
              <p class="text-justify">{{item.keterangan | limitTo:120}}...</p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="news">
    <div class="container">
      <h1 style="margin-bottom: 25px; text-align: center;">Objek Wisata</h1>
      <div class="row">
        <div ng-repeat="item in Wisatas" class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
          <div class="thumbnail">
            <div style="margin-left:12px; margin-right:12px">
              <a href="<?= base_url()?>guest/wisata/readwisata/{{item.idwisata}}">
                <h4>{{item.nama | limitTo:20}} <span ng-if="item.nama.length>20">...</span></h4>
              </a>
              <img src="<?= base_url('assets/img/wisata/foto/');?>{{item.foto}}" width="100%" height="150px" alt=""
                style="margin-bottom:10px">
              <p class="text-left">
                <a href="#" style="color: black;"><i class="fa fa-user"></i> &nbsp;
                  Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#" style="color: black;"><i class="fa fa-calendar"></i> &nbsp;
                  {{convertdate(item.modifier) | date: 'EEEE, dd MMM yyyy'}}</a>
              </p>
              <hr>
              <p class="text-justify">{{item.keterangan | limitTo:120}}...</p>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- container news -->

  <!-- gallery -->
  <div id="gallery">
    <div class="container">
      <h1>Gallery</h1>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="satu"><a href="{{gambar1}}" target="_blank"><img class="img-responsive"
            src="{{gambar1}}" width="3000px" width="100%" style="height:320px !important"></a></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="satu"><a href="{{gambar2}}" target="_blank"><img class="img-responsive"
            src="{{gambar2}}" width="300px" style="height:145px !important"></a></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="satu"><a href="{{gambar3}}" target="_blank"><img class="img-responsive"
            src="{{gambar3}}" width="300px" style="height:145px !important"></a></div>
        <div ng-if="gambar4" class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="dua"><a href="{{gambar4}}" target="_blank"><img class="img-responsive"
            src="{{gambar4}}" width="600px" style="height:145px !important"></a></div>
      </div>
    </div>
  </div>
</div>
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo&libraries=geometry,places&v=weekly"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<!-- gallery -->

<!-- about -->