<div id="top" ng-app="app" ng-controller="bukuTamuController">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 style="margin-bottom: 25px; text-align: center;">Buku Tamu</h1>
                <div id="bukutamu" class="row col-md-12">
                    <form ng-submit = "simpan()">
                        <div class="form-group row">
                            <label class="col-md-3">Nama<sup style="color: red;">*</sup></label>
                            <div class="col-md-9">
                                <input type="text" name="nama" class="form-control" ng-model="model.nama" placeholder="Nama Anda" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Email<sup style="color: red;">*</sup></label>
                            <div class="col-md-9">
                                <input type="email" name="nama" class="form-control" ng-model="model.email" placeholder="Email Anda" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3">Pesan<sup style="color: red;">*</sup></label>
                            <div class="col-md-9">
                                <textarea rows="4" class="form-control" ng-model="model.pesan" placeholder="Tinggalkan pesan disini" ></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary pull-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo&libraries=geometry,places&v=weekly"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>