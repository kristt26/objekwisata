<div class="row" ng-app="app" ng-controller="eventController">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Event Wisata</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <!-- <div class="col-sm-12" style="margin-bottom: 10px;">
                    <div class="row">
                        <div class="box-tools pull-right">
                            <button
                                class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah
                            </button>
                        </div>
                    </div>
                </div> -->
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div ng-repeat="item in datas.event" class="panel panel-default">
                            <div class="panel-heading" role="tab" id="heading{{item.idwisata}}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapse{{item.idwisata}}" aria-expanded="false"
                                        aria-controls="collapse{{item.idwisata}}">
                                        {{item.nama}}
                                    </a>
                                    <a href="<?= base_url()?>admin/event/add/{{item.idwisata}}"
                                        class="btn btn-primary btn-sm pull-right">Tambah
                                    </a>

                                </h4>
                            </div>
                            <div id="collapse{{item.idwisata}}"
                                class="panel-collapse collapse" role="tabpanel"
                                aria-labelledby="heading{{item.idwisata}}">
                                <div class="panel-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="10%">Nama Event</th>
                                                <th>Alamat</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Tanggal Posting</th>
                                                <th width="30%">Isi Event</th>
                                                <th>Foto</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr ng-repeat="itemevent in item.event">
                                                <td>{{$index+1}}</td>
                                                <td>{{itemevent.nama}}</td>
                                                <td>{{itemevent.alamat}}</td>
                                                <td>{{itemevent.tgl_mulai}}</td>
                                                <td>{{itemevent.tgl_selesai}}</td>
                                                <td>{{itemevent.tgl_posting}}</td>
                                                <td ng-bind-html="htmltotext(itemevent.isi) | limitTo: 300"></td>
                                                <td><img src="<?= base_url('assets/img/event/')?>{{itemevent.foto}}"
                                                        width="100px" /></td>
                                                <td class="action"><a
                                                        href="<?= base_url();?>admin/event/add/{{itemevent.idwisata}}/{{itemevent.idevent}}"
                                                        class="btn btn-default btn-edit-event"><i
                                                            class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger" ng-click="hapus(itemevent)"><i class="fa fa-recycle"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>