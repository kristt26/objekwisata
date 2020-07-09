<div class="row">
    <div class="data-flush" data-flash="<?= $this->session->flashdata('pesan');?>"></div>
<!-- <?php if ($this->session->flashdata('pesan')): ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?= $this->session->flashdata('pesan');?>
                    </div>
                    <?php endif;?> -->
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Objek Wisata</h3>
                
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button> -->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-sm-12" style="margin-bottom: 10px;">
                    <div class="row">
                        <div class="box-tools pull-right">
                            <button
                                class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php
                        $no = 1;
                         foreach ($wisata as $itemkategori):
                         ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?= $itemkategori['idkategori_wisata']?>">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $itemkategori['idkategori_wisata']?>"
                                            aria-expanded="false" aria-controls="collapse<?= $itemkategori['idkategori_wisata']?>">
                                            <?= $itemkategori['kategori']?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse<?= $itemkategori['idkategori_wisata']?>" class="panel-collapse collapse <?= $set = $no==1 ? 'in':'' ?>" role="tabpanel" aria-labelledby="heading<?= $itemkategori['idkategori_wisata']?>">
                                    <div class="panel-body">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Wisata</th>
                                                    <th>Alamat</th>
                                                    <th>Keterangan</th>
                                                    <th>long</th>
                                                    <th>Lat</th>
                                                    <th>Foto</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $noo = 1;
                                                    foreach($itemkategori['wisata'] as $itemwisata):
                                                ?>
                                                <tr>
                                                    <td><?= $noo;?></td>
                                                    <td><?= $itemwisata['nama'];?></td>
                                                    <td><?= $itemwisata['alamat'];?></td>
                                                    <td><?= $itemwisata['keterangan'];?></td>
                                                    <td><?= $itemwisata['long'];?></td>
                                                    <td><?= $itemwisata['lat'];?></td>
                                                    <td><img src="<?= base_url().'assets/img/wisata/foto/' . $itemwisata['foto'];?>" width = "100px"/></td>
                                                    <td class="action"><button
                                                        class="btn btn-default btn-edit-wisata" data-idwisata="<?= $itemwisata['idwisata'];?>" data-nama="<?= $itemwisata['nama'];?>" data-alamat="<?= $itemwisata['alamat'];?>" data-keterangan="<?= $itemwisata['keterangan'];?>" data-long="<?= $itemwisata['long'];?>" data-lat="<?= $itemwisata['lat'];?>"><i class="fa fa-edit"></i></button>
                                                        <button
                                                        class="btn btn-danger btn-delete-wisata" data-id="<?= $itemwisata['idwisata'];?>" data-url="<?php echo base_url();?>admin/wisata/hapus"><i class="fa fa-recycle"></i></button>
                                                    </td>
                                                </tr>
                                                <?php $noo++;?>
                                                <?php endforeach?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $no++;
                            endforeach;
                        ?>
                        <!-- <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        Collapsible Group Item #2
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf
                                    moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        Collapsible Group Item #3
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf
                                    moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                    Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda
                                    shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea
                                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim
                                    aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Objek Wisata</h4>
            </div>
            <div class="modal-body">
              <form action="<?= base_url();?>admin/wisata/tambah" method="post" enctype="multipart/form-data">
                <div class="box-body">
                    <div class="form-group">
                        <label>Kategori Wisata</label>
                        <select class="form-control" name="idkategori_wisata" id="idkategori">
                            <?php foreach($kategori as $row):?>
                            <option value="<?php echo $row['idkategori_wisata'];?>"><?php echo $row['nama'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Objek Wisata" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>long</label>
                        <input type="text" name="long" class="form-control" id="long" required>
                    </div>
                    <div class="form-group">
                        <label>lat</label>
                        <input type="text" name="lat" class="form-control" id="lat" required>
                    </div>
                    <div class="form-group">
                        <label>keterangan</label>
                        <textarea type="text" name="keterangan" class="form-control" id="keterangan" placeholder="keterangan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" size="20" />
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
                        <input type="text" name="nama" class="form-control nama" id="nama" placeholder="Objek Wisata" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea type="text" name="alamat" class="form-control alamat" id="alamat" placeholder="Alamat" required></textarea>
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
                        <textarea type="text" name="keterangan" class="form-control keterangan" id="keterangan" placeholder="keterangan" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto" size="20" />
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


