<div id="top" ng-app="app" ng-controller="eventController">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 style="margin-bottom: 25px; text-align: center;">Event Wisata</h1>
                <div class="row">
                    <div ng-repeat="item in datas.event" class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="thumbnail">
                            <div style="margin-left:12px; margin-right:12px">
                                <a href="<?= base_url()?>guest/event/readevent/{{item.idevent}}">
                                    <h4>{{item.nama | limitTo:20}} <span ng-if="item.nama.length>20">...</span></h4>
                                </a>
                                <img src="<?= base_url('assets/img/event/')?>{{item.foto}}" width="100%"
                                    height="150px" alt="" style="margin-bottom:10px">
                                <p class="text-left">
                                    <a href="#" style="color: black;"><i class="fa fa-user"></i> &nbsp;
                                        Admin</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="#" style="color: black;"><i class="fa fa-calendar"></i> &nbsp;
                                        {{convertdate(item.tgl_posting) | date: 'EEEE, dd MMM yyyy'}}</a>
                                </p>
                                <hr>
                                <p class="text-justify">{{item.stringtext | limitTo:120 }}</p>
                            </div>
                        </div>
                    </div>
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