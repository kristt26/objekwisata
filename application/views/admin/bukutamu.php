<div ng-app="app" ng-controller="bukutamuController">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Buku Tamu</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table id="example1" datatable="ng" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Tanggal Pesan</th>
                                <th>Lokasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.nama}}</td>
                                <td>{{item.email}}</td>
                                <td>{{item.pesan}}</td>
                                <td>{{convertdate(item.tgl_masuk) | date: 'EEEE, dd MMM yyyy'}}</td>
                                <td>{{item.location.city}}</td>
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


