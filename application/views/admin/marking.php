<div ng-app="app" ng-controller="markingController">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data Marking member</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Wisata</th>
                                <th style="width:15%">Alamat</th>
                                <th style="width:30%">Keterangan</th>
                                <th>long</th>
                                <th>Lat</th>
                                <th>Status</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="wisata in datas">
                                <td>{{$index+1}}</td>
                                <td>{{wisata.nama}}</td>
                                <td>{{wisata.alamat}}</td>
                                <td>{{wisata.keterangan | limitTo: 300}}...</td>
                                <td>{{wisata.long}}</td>
                                <td>{{wisata.lat}}</td>
                                <td>{{wisata.status}}</td>
                                <td><img src="<?= base_url().'assets/img/wisata/foto/';?>{{wisata.foto}}"
                                        width="100px" /></td>
                                <td class="action">
                                    <button class="btn btn-primary" ng-click = "ubah(wisata)"><i class="fa fa-check"></i></button>
                                    <button class="btn btn-danger"  ng-click = "hapus(wisata)"><i class="fa fa-recycle"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addedit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah Kategori Wisata</h4>
                </div>
                <div class="modal-body">
                    <form ng-submit="simpan()" method="post" enctype="multipart/form-data">
                        <div class="box-body">

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" ng-model="model.nama" class="form-control" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Icon</label>
                                <input type="text" ng-model="model.icon" class="form-control" required>
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