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
                <h3 class="box-title">Kategori Wisata</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button> -->
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="box-tools pull-right">
                            <button
                                class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Tambah
                            </button>
                        </div>
                    </div>
                </div>

                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            foreach($kategori as $value):
                        ?>
                        <tr>
                            <td><?= $no;?></td>
                            <td><?= $value['nama'];?></td>
                            <td class="action"><button
                                class="btn btn-default btn-edit" data-idkategori="<?= $value['idkategori_wisata'];?>" data-nama="<?= $value['nama'];?>"><i class="fa fa-edit"></i></button>
                                <button
                                class="btn btn-danger btn-delete" data-id="<?= $value['idkategori_wisata'];?>" data-url="<?php echo base_url();?>admin/kategori/hapus"><i class="fa fa-recycle"></i></button>
                            </td>
                        </tr>
                        <?php $no++;?>
                        <?php endforeach?>
                    </tbody>
                </table>
                <!-- /.row -->
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
                <h4 class="modal-title">Tambah Kategori Wisata</h4>
            </div>
            <div class="modal-body">
              <form action="<?= base_url();?>admin/kategori/tambah" method="post" enctype="multipart/form-data">
                <div class="box-body">

                  <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Kategori Wisata" required>
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
              <form action="<?= base_url();?>admin/kategori/ubah" method="post" enctype="multipart/form-data">
                <div class="box-body">

                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control edit-nama" id="nama" required>
                    <input type="hidden" name="idkategori" class="form-control edit-kategori" id="idkategori" required>
                  </div>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
              </form>
            </div>

        </div>
    </div>
</div>


