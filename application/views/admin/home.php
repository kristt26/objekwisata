<div ng-app="app" ng-controller="homeController">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Kategori Wisata</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Grafik Jumlah Wisata per Kategori</h3>
                            </div>
                            <div class="card-body">
                                <canvas id="myChart" class="chartjs" width="770" height="385"
                                    style="display: block; width: 770px; height: 385px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:40px;">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-success">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kategori Wisata</th>
                                    <th width="10%" style="text-align: center;">Total Wisata</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in datas">
                                    <td>{{$index+1}}</td>
                                    <td>{{item.nama}}</td>
                                    <td class="text-center">{{item.totalwisata}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>