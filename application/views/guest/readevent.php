<div id="top" ng-app="app" ng-controller="readeventController">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1><?= $event->nama;?></h1>
                <div class="row">
                    <img src="<?= base_url().'assets/img/event/'.$event->foto?>" width="100%" height="500px" alt="">
                </div>
                <div class="tombol" style="margin-bottom:10px">
                    <h5 style="margin-right:20px;"><i class="fa fa-user"></i>&nbsp;&nbsp;ADMIN</h5>
                    <h5><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?= $event->tgl_posting;?></h5>
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
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo&libraries=geometry,places&v=weekly"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>