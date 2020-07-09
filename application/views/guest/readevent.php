<div id="top">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1><?= $event->nama;?></h1>
                <div class="tombol">
                    <h5 style="margin-right:20px;"><i class="fa fa-user"></i>&nbsp;&nbsp;ADMIN</h5>
                    <h5><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?= $event->tgl_posting;?></h5>
                </div>
                <div class="row">
                    <img src="<?= base_url().'assets/img/event/'.$event->foto?>" width="100%" height="500px" alt="">
                </div>
                <div class="text-justify">
                    <?= $event->isi;?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>