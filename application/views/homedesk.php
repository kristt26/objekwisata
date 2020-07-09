  <div id="background">
    <div class="jumbotron">
      <h1>Danau Sentai</h1>
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
  <div id="news">
    <div class="container">
      <h1 style="margin-bottom: 25px; text-align: center;">Event Wisata</h1>
      <div class="row">
        <?php foreach($event as $item):?>
          <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
            <div class="thumbnail">
              <div style="margin-left:12px; margin-right:12px">
                <a href="<?= base_url()?>guest/event/readevent/<?= $item->idevent; ?>"><h3 style="text-align:center;"><?= $item->nama; ?></h3></a>
                <p class="text-justify"><?= $item->stringtext . ' ...'?></p>
                <hr>
                <p  class="text-center">
                  <a href="#" style="color: black;"><i class="fa fa-user"></i> &nbsp; ADMIN</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="#" style="color: black;"><i class="fa fa-calendar"></i> &nbsp; <?= $item->tgl_posting?></a>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
  <!-- container news -->

  <!-- gallery -->
  <div id="gallery">
    <div class="container">
      <h1>Gallery</h1>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="satu"><img class="img-responsive" src="<?= base_url()?>assets/img/gambar-3-A.jpg" width="3000px"></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="satu"><img class="img-responsive" src="assets/img/gambar-3-B.jpg" width="300px"></div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="satu"><img class="img-responsive" src="assets/img/gambar-3-C.jpg" width="300px"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="dua"><img class="img-responsive" src="assets/img/gambar-3-D.jpg" width="600px"></div>
      </div>
    </div>
  </div>
  <!-- gallery -->

  <!-- about -->
  <div id="about">
    <div class="container footer">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h1> <img src="assets/img/logoo.png" width="180px"></h1>
        <h2>About Us</h2>
        <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus...</p>
      </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <h2>Newsletter Subscription</h2>
          <div class="input-group input-group-lg">
            <input type="text" class="form-control" value="Your Email">
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit">Subscribe </button>
            </div>
          </div>
          <div id="icon"><i class="fa fa-instagram"></i><i class="fa fa-facebook-official"></i><i class="fa fa-twitter-square"></i><i class="fa fa-youtube-play"></i></div>
        </div>
    </div>
  </div>


