<div ng-app="app" ng-controller="readwisataController" ng-init="Init()">
    <div id="top">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 style="margin-bottom: 25px; text-align: center;">{{datas.wisata.nama | uppercase}}</h1>
                    <div class="row">
                        <img src="{{url}}/objekwisata/assets/img/wisata/foto/{{datas.wisata.foto}}" width="100%" height="500px"
                            alt="">
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="page-header">
                                Description
                            </h3>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="text-justify">
                        {{datas.wisata.keterangan}}
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="page-header">
                                Maps
                            </h3>
                            <div  id="map-panel">
                                    <input id="pac-input" class="controls" type="text" placeholder="Search Box"/>
                                    <div id="map" ></div>
                                    <div id="directions-panel"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambah-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah Kategori Wisata</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url();?>marker/simpan/<?= $wisata->idwisata;?>" method="post"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Longitude</label>
                                <input type="hidden" name="idwisata" class="form-control idwisata" id="idwisata">
                                <input type="text" name="long" class="form-control long" id="long" required>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Latitude</label>
                                <input type="text" name="lat" class="form-control lat" id="lat" required>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Lokasi</label>
                                <input type="text" name="city" class="form-control city" id="city" required>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Keterangan</label>
                                <input type="text" name="desc" class="form-control desc" id="desc" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" id="batal"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo" type="text/javascript"></script> -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js" type="text/javascript"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo&libraries=geometry,places&v=weekly"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>



<style>
#directions-panel{
    margin:20px;
}


#map-panel{
    height:auto;
    justify-content: space-between;
    align-items: stretch;
    
}

#map-panel > #map{
    width:100%;
    background-color:red;
    min-height:500px;
    height:100%;
}

#map-panel > #directions-panel{
    max-width:300px;
    height:100%;
}
.pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
      }

      #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
      }

      .pac-controls {
        display: inline-block;
        padding: 5px 11px;
      }

      .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
      }
      #target {
        width: 345px;
    }



</style>