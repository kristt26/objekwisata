<div class="row" ng-app="app" ng-controller="addeventController">
    <div class="data-flush" data-flash="<?= $this->session->flashdata('pesan');?>"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= $title?> Event Wisata</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="col-sm-12">
                    <div class="row">
                        <form action="<?= $url = $wisata->jenis==='event'? base_url().'admin/event/ubah' :base_url().'admin/event/tambah'?>" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <?php if($wisata->jenis!=='event'){?>
                                    <div class="form-group">
                                        <label>Kategori Wisata</label>
                                        <label>Wisata</label>
                                        <input type="text" class="form-control" id="nama" value="<?= $wisata->nama;?>" required disabled>
                                        <input type="hidden" class="form-control" name="idwisata" id="idwisata" value="<?= $wisata->idwisata;?>">
                                    </div>
                                <?php }else{ ?>
                                    <input type="hidden" class="form-control" name="idevent" id="idevent" value="<?= $wisata->idevent;?>">
                                <?php };?>
                                <div class="form-group">
                                    <label>Nama Event</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $nama = $wisata->jenis==='event'? $wisata->nama : '';?>" placeholder="Nama Event" required>
                                </div>
                                <div class="form-group">
                                    <label>Lokasi</label>
                                    <textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Lokasi Event" required><?= $alamat = $wisata->jenis==='event'? $wisata->alamat : '';?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="text" name="tgl_mulai" class="form-control datepicker" value="<?= $tgl_mulai = $wisata->jenis==='event'? $wisata->tgl_mulai : '';?>" placeholder="Tanggal Mulai" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="text" name="tgl_selesai" class="form-control" id="datepicker1" value="<?= $tgl_selesai = $wisata->jenis==='event'? $wisata->tgl_selesai : '';?>" placeholder="Tanggal Selesai" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Posting</label>
                                    <input type="text" name="tgl_posting" class="form-control" id="datepicker2" value="<?= $tgl_posting = $wisata->jenis==='event'? $wisata->tgl_posting : '';?>" placeholder="Tanggal Posting" required>
                                </div>
                                <div class="form-group">
                                    <label>Isi Event</label>
                                    <textarea id="editor1" type="text" name="isi" class="form-control" placeholder="keterangan" required><?= $isi = $wisata->jenis==='event'? $wisata->isi : '';?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto" size="20" value="<?= $tgl_posting = $wisata->jenis==='event'? $wisata->foto : '';?>" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="<?= base_url();?>admin/event" class="btn btn-default pull-left" data-dismiss="modal">Batal</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
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
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        // $('.textarea').wysihtml5()
    })
</script>


