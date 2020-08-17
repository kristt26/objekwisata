<div ng-app="app" ng-controller="userController">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Data User</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <table datatable="ng" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Gambar</th>
                                <th>Register By</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in datas">
                                <td>{{$index+1}}</td>
                                <td>{{item.nama}}</td>
                                <td>{{item.alamat}}</td>
                                <td>{{item.jk}}</td>
                                <td>{{item.email}}</td>
                                <td>{{status(item.status)}}</td>
                                <td ng-if="item.picture"><img src="{{item.picture}}" alt="" width = 100px></td>
                                <td ng-if="!item.picture">Tidak ada foto</td>
                                <td ng-if="item.oauth_uid">Goggle</td>
                                <td ng-if="!item.oauth_uid">System</td>
                                <td class="action">
                                    <button ng-if="item.status=='Aktif'" class="btn btn-danger" ng-click="ubah(item)" title="Aktifkan"><i class="fa fa-remove"></i></button>
                                    <button ng-if="item.status=='Pending'" class="btn btn-primary" ng-click="ubah(item)" title="non aktifkan"><i class="fa fa-check"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


