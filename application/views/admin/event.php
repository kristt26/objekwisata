<div class="row">
    <div class="data-flush" data-flash="<?= $this->session->flashdata('pesan');?>"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Objek Wisata</h3>
                
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
                        <?php
                        $no = 1;
                         foreach ($model as $item):
                         ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?= $item['idwisata']?>">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $item['idwisata']?>"
                                            aria-expanded="false" aria-controls="collapse<?= $item['idwisata']?>">
                                            <?= $item['nama']?>
                                        </a>
                                        <a href="<?= base_url()?>admin/event/add/<?= $item['idwisata'];?>"
                                            class="btn btn-primary btn-sm pull-right" >Tambah
                                        </a>

                                    </h4>
                                </div>
                                <div id="collapse<?= $item['idwisata']?>" class="panel-collapse collapse <?= $set = $no==1 ? 'in':'' ?>" role="tabpanel" aria-labelledby="heading<?= $item['idwisata']?>">
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
                                                <?php 
                                                    $noo = 1;
                                                    foreach($item['event'] as $itemevent):
                                                ?>
                                                <tr>
                                                    <td><?= $noo;?></td>
                                                    <td><?= $itemevent->nama;?></td>
                                                    <td><?= $itemevent->alamat;?></td>
                                                    <td><?= $itemevent->tgl_mulai;?></td>
                                                    <td><?= $itemevent->tgl_selesai;?></td>
                                                    <td><?= $itemevent->tgl_posting;?></td>
                                                    <td><?= $itemevent->stringtext.' ...';?></td>
                                                    <td><img src="<?= base_url().'assets/img/event/' . $itemevent->foto;?>" width = "100px"/></td>
                                                    <td class="action"><a href="<?= base_url();?>admin/event/add?idevent=<?= $itemevent->idevent?>"
                                                        class="btn btn-default btn-edit-event"><i class="fa fa-edit"></i></a>
                                                        <button class="btn btn-danger btn-delete-event" data-id="<?= $itemevent->idevent;?>" data-url="<?php echo base_url();?>admin/event/hapus"><i class="fa fa-recycle"></i></button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function () {
    $(document).ready(function () {
        $('.btn-delete-event').on('click', function () {
            // get data from button edit
            const id = $(this).data('id');
            const Url = $(this).data('url');
            // Set data to Form Edit
            // $('.edit-kategori').val(idkategori);
            swal({
                title: "Anda Yakin?",
                text: "Akan Melakukan Penghapusan data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: Url,
                            data: { 'id': id },
                            success: function (data) {
                                swal("Information!", "Berhasil di Hapus", "success")
                                    .then((value) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });
    });
})
</script>

