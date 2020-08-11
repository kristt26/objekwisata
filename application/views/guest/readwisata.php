<div ng-app="app" ng-controller="readwisataController" ng-init="Init()">
    <div id="top">
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h1 style="margin-bottom: 25px; text-align: center;">{{datas.wisata.nama | uppercase}}</h1>
                    <div class="row">
                        <img src="{{url}}/assets/img/wisata/foto/{{datas.wisata.foto}}" width="100%" height="500px"
                            alt="">
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3 class="page-header">
                                Description
                            </h3>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="text-justify">
                        {{datas.wisata.keterangan}}
                    </div>
                    <div class="row">
                        <div class="col-xs-12">

                            <h3 class="page-header">
                                Maps
                            </h3>
                            <div class="panel panel-default">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <ng-map zoom="13" scrollwheel="true" default-style="false" style="height: 500px"
                                            zoom-to-include-markers="false" center="{{lat}},{{long}}"
                                            on-rightclick="addMarker()" default-style="true">
                                            <marker position="[{{lat}},{{long}}]"
                                                icon="https://img.icons8.com/ultraviolet/40/000000/marker.png"
                                                on-click="detail(event)">
                                            </marker>
                                            <marker position="[{{curentlat}},{{curentlong}}]"
                                                icon="https://img.icons8.com/ultraviolet/40/000000/location-off.png"
                                                on-click="detail(event)">
                                            </marker>
                                            <directions
                                                    draggable="true"
                                                    panel=directions-panel
                                                    travel-mode="DRIVING"
                                                    origin="{{curentlat}},{{curentlong}}"
                                                    destination="{{lat}},{{long}}">
                                            </directions>
                                        </ng-map>
                                    </div>
                                    <div>
                                    <div id="directions-panel" class="col-xs-4"></div>
                                    </div>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambah-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Ubah Kategori Wisata</h4>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url();?>marker/simpan/<?= $wisata->idwisata;?>" method="post"
                        enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Longitude</label>
                                <input type="hidden" name="idwisata" class="form-control idwisata" id="idwisata">
                                <input type="text" name="long" class="form-control long" id="long" required>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Latitude</label>
                                <input type="text" name="lat" class="form-control lat" id="lat" required>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Lokasi</label>
                                <input type="text" name="city" class="form-control city" id="city" required>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="nama">Keterangan</label>
                                <input type="text" name="desc" class="form-control desc" id="desc" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" id="batal"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo"></script>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyByGhiEjG2rcKsVqYXwJOtUugy0BS55_lo" type="text/javascript"></script> -->
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js" type="text/javascript"></script> -->
<!-- <script>
    idwisata = $('.data-center').data('idwisata');
    nama = $('.data-center').data('nama');
    var itemmark = [];

    $(document)
        .on('click', '#clearmap', clearmap)
        .on('click', '#simpandaftarkoordinatjembatan', simpandaftarkoordinatjembatan);
    var map;
    var markers = [];
    var pos = {};

    function initialize() {
        var longc = parseFloat($('.data-center').data('long'));
        var latc = parseFloat($('.data-center').data('lat'));
        itemmark =
        {
            city: $('.data-center').data('city'),
            lat: latc,
            long: longc,
            nama: $('.data-center').data('nama'),
            keterangan: $('.data-center').data('keterangan'),
        };
        var myLatLng = { lat: longc, lng: latc };

        var mapOptions = {
            zoom: 14,
            center: new google.maps.LatLng(longc - 0.000009, latc - 0.000007)
        };

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        initMarker(itemmark);
        currentPossition();
        showMarker();
        google.maps.event.addListener(map, 'dblclick', addLatLng);
        google.maps.event.addListener(map, "dblclick", function (event) {
            var lat = event.latLng.lat();
            var long = event.latLng.lng();
            var a = { 'lat': lat, 'long': long };
            $('.lat').val(lat);
            $('.long').val(long);
            $('.idwisata').val(idwisata);
            $('#tambah-data').modal('show');
        });
    }

    function showMarker(){
        var Url = "<?= base_url();?>" + "marker/ambil/" + idwisata;
        var settings = {
            "crossDomain": true,
            "url": Url,
            "method": "GET",
            "processData": false,
        }

        $.ajax(settings).done(function (response) {
            var dataMarking = JSON.parse(response);
            dataMarking.forEach(loopmarker);
        });
    }

    function loopmarker(item, index){
        itemmarking =
        {
            city: item.city,
            lat: parseFloat(item.long),
            long: parseFloat(item.lat),
            nama: item.title,
            keterangan: item.desc,
        };
        initMarker(itemmarking);
    }
    function addLatLng(event) {
        var marker = new google.maps.Marker({
            position: event.latLng,
            title: 'New Marker',
            map: map
        });
        markers.push(marker);
    }
    function initMarker(event) {
        var marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(parseFloat(event.long), parseFloat(event.lat)),
            title: event.nama
        });
        var contentString = '<h2>' + marker.title + '</h2>' + '<div class="infoWindowContent">' + event.keterangan + '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        marker.addListener('click', function () {
            infowindow.open(map, marker);
            var tujuan = { 'lat': event.lat, 'lng': event.long };
            var hitungjarak = jarak(pos, tujuan)
        });
        markers.push(marker);

    }

    function currentPossition() {
        infoWindow1 = new google.maps.InfoWindow;

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                pos = {
                    lat: position.coords.latitude,
                    long: position.coords.longitude
                };
            }, function () {
                handleLocationError(true, infoWindow1, map.getCenter());
            });
        } else {
            handleLocationError(false, infoWindow1, map.getCenter());
        }
    }

    function jarak(awal, tujuan) {
        var directionsRenderer = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();

        directionsRenderer.setMap(map);
        directionsRenderer.setPanel(document.getElementById("right-panel"));
        calculateAndDisplayRoute(directionsService, directionsRenderer, awal, tujuan);
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer, awal, tujuan) {
        var start = new google.maps.LatLng(awal.long, awal.lat);
        var end = new google.maps.LatLng(tujuan.lat, tujuan.lng);
        var request = {
            origin: start, 
            destination: end, 
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
             unitSystem: google.maps.UnitSystem.IMPERIAL
        };
        directionsService.route(request, function(response, status) {
            if (status == 'OK') {
                directionsRenderer.setDirections(response);
            }else{
                window.alert("Directions request failed due to " + status);
            }
        },err=>{

        });
    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
    }
    function clearmap(e) {
        e.preventDefault();
        $('#latitude').val('');
        $('#longitude').val('');
        setMapOnAll(null);
    }
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
        markers = [];
    }

    function simpandaftarkoordinatjembatan(e) {
        e.preventDefault();
        var datakoordinat = { 'id_jembatan': $('#id_jembatan').val(), 'latitude': $('#latitude').val(), 'longitude': $('#longitude').val() };
        console.log(datakoordinat);
        $.ajax({
            url: '<?php echo site_url("admin/simpandaftarkoordinatjembatan") ?>',
            dataType: 'json',
            data: datakoordinat,
            type: 'POST',
            success: function (data, status) {
                if (data.status != 'error') {
                    $('#daftarkoordinatjembatan').load('<?php echo current_url()."/ #daftarkoordinatjembatan > *" ?>');
                    alert(data.msg);
                    clearmap(e);
                } else {
                    alert(data.msg);
                }
            }
        })
    }
    function hapusmarkerjembatan(e) {
        e.preventDefault();
        var datakoordinat = { 'id_jembatan': $(this).data('iddatajembatan') };
        $.ajax({
            url: '<?php echo site_url("admin/hapusmarkerjembatan") ?>',
            data: datakoordinat,
            dataType: 'json',
            type: 'POST',
            success: function (data, status) {
                if (data.status != 'error') {
                    alert(data.msg);
                    $('#daftarkoordinatjembatan').load('<?php echo current_url()."/ #daftarkoordinatjembatan > *" ?>');
                    clearmap(e);
                } else {
                    alert(data.msg);
                }
            }
        })
    }
    function viewmarkerjembatan(e) {
        e.preventDefault();
        var datakoordinat = { 'id_jembatan': $(this).data('iddatajembatan') };
        $.ajax({
            url: '<?php echo site_url("admin/viewmarkerjembatan") ?>',
            data: datakoordinat,
            dataType: 'json',
            type: 'POST',
            success: function (data, status) {
                if (data.status != 'error') {
                    clearmap(e);
                    $.each(data.msg, function (m, n) {
                        var myLatLng = { lat: parseFloat(n["latitude"]), lng: parseFloat(n["longitude"]) };
                        console.log(m, n);
                        $.each(data.datajembatan, function (k, v) {
                            addMarker(v['namajembatan'], myLatLng);
                        })
                        return false;
                    })
                } else {
                    alert(data.msg);
                }
            }
        })
    }
    function addMarker(nama, location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: nama
        });
        markers.push(marker);
    }
</script> -->