<div ng-app="app" ng-controller ="wisataController" ng-init="Init()">
    <div id="top">
        <div class="container">
        
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 style="margin-bottom: 25px; text-align: center;">Objek Wisata</h1>
                    <div class="row">
                        <div  ng-repeat="item in datas.wisata" class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="thumbnail">
                                <div style="margin-left:12px; margin-right:12px">
                                    <a href="<?= base_url()?>guest/wisata/readwisata/{{item.idwisata}}">
                                        <h4>{{item.nama | limitTo:20}} <span ng-if="item.nama.length>20">...</span></h4>
                                    </a>
                                    <img src="<?= base_url('assets/img/wisata/foto/');?>{{item.foto}}" width="100%" height="150px" alt="" style="margin-bottom:10px">
                                    <p class="text-left">
                                        <a href="#" style="color: black;"><i class="fa fa-user"></i> &nbsp;
                                            Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="#" style="color: black;"><i class="fa fa-calendar"></i> &nbsp; {{convertdate(item.modifier) | date: 'EEEE, dd MMM yyyy'}}</a>
                                    </p>
                                    <hr>
                                    <p class="text-justify">{{item.keterangan | limitTo:120}}...</p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-xs-12">
                        <h3 class="page-header">
                            Maps
                        </h3>
                        <div id="map-panel">
                            <input id="pac-input" class="controls" type="text" placeholder="Search Box" />
                            <div id="map"></div>
                            <div id="directions-panel"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="addwisata">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tambah Objek Wisata</h4>
                </div>
                <div class="modal-body">
                    <form ng-submit="simpan()" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Kategori Wisata<sup style="color: red;">*</sup></label>
                                <select class="form-control" ng-options="item as item.nama for item in datas.kategori"
                                    ng-model="kategori" ng-change="model.idkategori_wisata=kategori.idkategori_wisata">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama<sup style="color: red;">*</sup></label>
                                <input type="text" name="nama" class="form-control" ng-model="model.nama"
                                    placeholder="Objek Wisata" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat<sup style="color: red;">*</sup></label>
                                <textarea type="text" ng-model="model.alamat" class="form-control" id="alamat"
                                    placeholder="Alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>long<sup style="color: red;">*</sup></label>
                                <input type="text" ng-model="model.long" class="form-control" id="long" disabled>
                            </div>
                            <div class="form-group">
                                <label>lat<sup style="color: red;">*</sup></label>
                                <input type="text" ng-model="model.lat" class="form-control" id="lat" disabled>
                            </div>
                            <div class="form-group">
                                <label>Biaya Pondok<sup style="color: red;">*</sup></label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input ng-disabled="model.status && model.status != 'Draf'" type="text" class="form-control text-right" id="biayapondok" ng-model="model.biayapondok" ui-number-mask="0" required>
                                    <span class="input-group-addon">,00</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Biaya Parkir<sup style="color: red;">*</sup></label>
                                <div class="input-group">
                                    <span class="input-group-addon">Rp.</span>
                                    <input ng-disabled="model.status && model.status != 'Draf'" type="text" class="form-control text-right" id="biayaparkir" ng-model="model.biayaparkir" ui-number-mask="0" required>
                                    <span class="input-group-addon">,00</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>keterangan<sup style="color: red;">*</sup></label>
                                <textarea type="text" ng-model="model.keterangan" class="form-control" rows="10" id="keterangan"
                                    placeholder="keterangan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto Wisata<sup style="color: red;">*</sup></label>
                                <div class="form-group inputDnD">
                                    <!-- <label class="sr-only" for="inputFile">File Upload</label> -->
                                    <input ng-disabled="model.status && model.status != 'Draf'" type="file"
                                        class="form-control-file form-control-sm text-secondary font-weight-bold"
                                        id="inputFile" file-model="myFile" accept="image/*, application/pdf"
                                        data-title="{{fileTitle}}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
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