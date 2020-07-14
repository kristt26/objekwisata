<div class="data-center" data-lat="<?= $wisata->lat?>" data-long="<?= $wisata->long?>" data-city="Papua"
    data-keterangan="<?= $wisata->keterangan?>" data-nama="<?= $wisata->nama?>" data-idwisata="<?= $wisata->idwisata?>"></div>
<div id="top">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1><?= $wisata->nama;?></h1>
                <div class="tombol">
                    <h5 style="margin-right:20px;"><i class="fa fa-user"></i>&nbsp;&nbsp;ADMIN</h5>
                    <!-- <h5><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?= $wisata->tgl_posting;?></h5> -->
                </div>
                <div class="row">
                    <img src="<?= base_url().'assets/img/wisata/foto/'.$wisata->foto?>" width="100%" height="500px"
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
                    <?= $wisata->keterangan;?>
                </div>
                <div class="row">
                    <div class="col-xs-12">

                        <h3 class="page-header">
                            Maps
                        </h3>

                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="panel-body" style="margin-bottom:-30px !important">
                                        <div class="tombol">
                                            <a href="#tab_1" data-toggle="tab" style="width: 50%;">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-marker"><i
                                                            class="fa fa-map-marker"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Marker</span>
                                                    </div>
                                                    <!-- /.info-box-content -->
                                                </div>
                                                <!-- /.info-box -->
                                            </a>
                                            <a href="#tab_2" data-toggle="tab" style="width: 50%;">
                                                <div class="info-box">
                                                    <span class="info-box-icon bg-marker"><i
                                                            class="fa fa-map-marker"></i></span>

                                                    <div class="info-box-content">
                                                        <span class="info-box-text">Street</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_1">
                                            <div class="panel-body">
                                                <div class="col-md-12 col-sm-12 col-xs-12" style="height:400px;"
                                                    id="map-canvas"></div>
                                            </div>
                                            <div class="panel-body">
                                                <div style="min-height:400px;;">
                                                    <table class="table table-bordered table-hover">
                                                        <th>No</th>
                                                        <th>Data jembatan</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th></th>
                                                        <tbody id="daftarkoordinatjembatan">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_2">
                                            <div class="tab-pane active" id="tab_1">
                                                <div class="panel-body">
                                                    The European languages are members of the same family. Their
                                                    separate
                                                    existence is a myth.
                                                    For science, music, sport, etc, Europe uses the same vocabulary. The
                                                    languages only differ
                                                    in their grammar, their pronunciation and their most common words.
                                                    Everyone
                                                    realizes why a
                                                    new common language would be desirable: one could refuse to pay
                                                    expensive
                                                    translators. To
                                                    achieve this, it would be necessary to have uniform grammar,
                                                    pronunciation
                                                    and more common
                                                    words. If several languages coalesce, the grammar of the resulting
                                                    language
                                                    is more simple
                                                    and regular than that of the individual languages.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.tab-content -->
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaXpkAhOkqROHQ_eKi1z6M2o2RsR1QDIk&callback=initialize"
  type="text/javascript"></script>
<script>
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
        // addMarker(itemmark);

        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        initMarker(itemmark);
        currentPossition();
        showMarker();
        // Add a listener for the click event
        google.maps.event.addListener(map, 'dblclick', addLatLng);
        google.maps.event.addListener(map, "dblclick", function (event) {
            var lat = event.latLng.lat();
            var long = event.latLng.lng();
            var a = { 'lat': lat, 'long': long };
            $('.lat').val(lat);
            $('.long').val(long);
            $('.idwisata').val(idwisata);
            $('#tambah-data').modal('show');
            //alert(lat +" dan "+lng);
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

	/**
	 * Handles click events on a map, and adds a new point to the marker.
	 * @param {google.maps.MouseEvent} event
     
	 */
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

        // var infowindow = new google.maps.InfoWindow({
        //     content: '<h2>' + marker.title + '</h2>' + marker.content;
        // });
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });

        marker.addListener('click', function () {
            infowindow.open(map, marker);
            var tujuan = { 'lat': event.lat, 'lng': event.long };
            var hitungjarak = jarak(pos, tujuan)

            // $('#tambah-data').modal('show');

        });

        // marker.addListener('click', function () {
        //     infowindow.open(map, marker);
        // });

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

                // infoWindow1.setPosition(pos);
                // infoWindow1.setContent('Location found.');
                // infoWindow1.open(map);
                // map.setCenter(pos);
            }, function () {
                handleLocationError(true, infoWindow1, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow1, map.getCenter());
        }
    }

    function jarak(awal, tujuan) {
        var directionsRenderer = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();

        directionsRenderer.setMap(map);
        directionsRenderer.setPanel(document.getElementById("right-panel"));

        // var control = document.getElementById("floating-panel");
        // control.style.display = "block";
        // map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
        calculateAndDisplayRoute(directionsService, directionsRenderer, awal, tujuan);

        // var onChangeHandler = function() {

        // };
        // document.getElementById("start").addEventListener("change", onChangeHandler);
        // document.getElementById("end").addEventListener("change", onChangeHandler);

    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer, awal, tujuan) {
        // var start = document.getElementById("start").value;
        // var end = document.getElementById("end").value;
        var start = new google.maps.LatLng(awal.long, awal.lat);
        var end = new google.maps.LatLng(tujuan.lat, tujuan.lng);
        var request = {
            origin: start, // Haight.
            destination: end, // Ocean Beach.
            // Note that Javascript allows us to access the constant
            // using square brackets and a string value as its
            // "property."
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
                    //load marker
                    $.each(data.msg, function (m, n) {
                        var myLatLng = { lat: parseFloat(n["latitude"]), lng: parseFloat(n["longitude"]) };
                        console.log(m, n);
                        $.each(data.datajembatan, function (k, v) {
                            addMarker(v['namajembatan'], myLatLng);
                        })
                        return false;
                    })
                    //end load marker
                } else {
                    alert(data.msg);
                }
            }
        })
    }
    // Menampilkan marker lokasi jembatan
    function addMarker(nama, location) {
        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: nama
        });
        markers.push(marker);
    }
</script>