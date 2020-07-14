<div id="top">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 style="margin-bottom: 25px; text-align: center;">Event Wisata</h1>
                <div class="row">
                    <?php foreach($wisata as $item):?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="thumbnail">
                            <div style="margin-left:12px; margin-right:12px">
                                <a href="<?= base_url()?>guest/wisata/readwisata/<?= $item->idwisata;?>"><h3 style="text-align:center;"><?= $item->nama; ?></h3></a>
                                <p class="text-justify"><?= $item->keterangan . ' ...'?></p>
                                <hr>
                                <p  class="text-center">
                                <a href="#" style="color: black;"><i class="fa fa-user"></i> &nbsp; ADMIN</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <!-- <a href="#" style="color: black;"><i class="fa fa-calendar"></i> &nbsp; <?= $item->tgl_posting?></a> -->
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="top">
    <div class="container">
        
    </div>
</div>