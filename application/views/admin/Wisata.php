<div class="row" ng-app="app" ng-controller="wisataController">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Objek Wisata</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-sm-12" style="margin-bottom: 10px;">
                    <div class="row">
                        <div class="box-tools pull-right">
                            <a href="<?= base_url('admin/tambahwisata');?>" class="btn btn-primary">Tambah
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default" ng-repeat="kategori in datas.wisata">
                            <div class="panel-heading" role="tab" id="heading{{kategori.idkategori_wisata}}">
                                <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion"
                                        href="#collapse{{kategori.idkategori_wisata}}" aria-expanded="false"
                                        aria-controls="collapse{{kategori.idkategori_wisata}}">
                                        <img src="{{kategori.icon}}" alt=""> {{kategori.kategori}}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{kategori.idkategori_wisata}}"
                                class="panel-collapse collapse {{$index==0 ? 'in' : ''}}" role="tabpanel"
                                aria-labelledby="heading{{kategori.idkategori_wisata}}">
                                <div class="panel-body">
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
                                            <tr ng-repeat="wisata in kategori.wisata">
                                                <td>{{$index+1}}</td>
                                                <td>{{wisata.nama}}</td>
                                                <td>{{wisata.alamat}}</td>
                                                <td>{{wisata.keterangan | limitTo: 300}}...</td>
                                                <td>{{wisata.long}}</td>
                                                <td>{{wisata.lat}}</td>
                                                <td>{{wisata.status}}</td>
                                                <td><img src="<?= base_url().'assets/img/wisata/foto/';?>{{wisata.foto}}"
                                                        width="100px" /></td>
                                                <td class="action"><button class="btn btn-default btn-edit-wisata"><i class="fa fa-edit"></i></button>
                                                    <button class="btn btn-danger btn-delete-wisata"><i class="fa fa-recycle"></i></button>
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
        <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="modal fade" id="modal-default">
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
                                <select class="form-control" ng-options="item as item.nama for item in datas.kategori" ng-model="kategori" 
                                    ng-change="model.idkategori_wisata=kategori.idkategori_wisata">
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama<sup style="color: red;">*</sup></label>
                                <input type="text" name="nama" class="form-control" ng-model="model.nama" placeholder="Objek Wisata"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Alamat<sup style="color: red;">*</sup></label>
                                <textarea type="text"  ng-model="model.alamat" class="form-control" id="alamat"
                                    placeholder="Alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>long<sup style="color: red;">*</sup></label>
                                <input type="text"  ng-model="model.long" class="form-control" id="long" required>
                            </div>
                            <div class="form-group">
                                <label>lat<sup style="color: red;">*</sup></label>
                                <input type="text"  ng-model="model.lat" class="form-control" id="lat" required>
                            </div>
                            <div class="form-group">
                                <label>lat<sup style="color: red;">*</sup></label>
                                <input type="text"  ng-model="model.biayapondok" class="form-control" id="lat" required>
                            </div>
                            <div class="form-group">
                                <label>lat<sup style="color: red;">*</sup></label>
                                <input type="text"  ng-model="model.biayaparkir" class="form-control" id="lat" required>
                            </div>
                            <div class="form-group">
                                <label>keterangan<sup style="color: red;">*</sup></label>
                                <textarea type="text"  ng-model="model.keterangan" class="form-control" id="keterangan"
                                    placeholder="keterangan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto Wisata<sup style="color: red;">*</sup></label>
                                <div class="form-group inputDnD">
                                    <!-- <label class="sr-only" for="inputFile">File Upload</label> -->
                                    <input ng-disabled="model.status && model.status != 'Draf'" type="file" class="form-control-file form-control-sm text-secondary font-weight-bold" id="inputFile" 
                                    file-model = "myFile" accept="image/*, application/pdf" data-title="{{fileTitle}}">
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
    <div class="modal fade" id="edit-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah Kategori Wisata</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url();?>admin/wisata/ubah" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <!-- <label>Kategori Wisata</label>
                        <div>
                        <select class="form-control" name="idkategori_wisata">
                                <?php foreach($kategori as $row):?>
                                <option value="<?php echo $row['idkategori_wisata'];?>"><?php echo $row['nama'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div> -->
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="hidden" name="idwisata" class="idwisata" id="idwisata">
                                <input type="text" name="nama" class="form-control nama" id="nama"
                                    placeholder="Objek Wisata" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea type="text" name="alamat" class="form-control alamat" id="alamat"
                                    placeholder="Alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>long</label>
                                <input type="text" name="long" class="form-control long" id="long" required>
                            </div>
                            <div class="form-group">
                                <label>lat</label>
                                <input type="text" name="lat" class="form-control lat" id="lat" required>
                            </div>
                            <div class="form-group">
                                <label>keterangan</label>
                                <textarea type="text" name="keterangan" class="form-control keterangan" id="keterangan"
                                    placeholder="keterangan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" class="form-control" name="foto" size="20" />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>