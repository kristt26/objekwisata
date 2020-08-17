(function (angular) {
  'use strict'
  var geocoder = new google.maps.Geocoder;

  angular.module('ctrlguest', ['ngMap', 'userdata.service', 'helper.service'])
    .controller('readwisataController', readwisataController)
    .controller('wisataController', wisataController)
    .controller('homeController', homeController)
    .controller('eventController', eventController)
    .controller('bukuTamuController', bukuTamuController)
    .controller('readeventController', readeventController);
  function readwisataController($scope, $http, NgMap, readWisataService, helperServices) {
    $scope.url = helperServices.url;
    $scope.datas = []
    let googleMap;
    $scope.Init = () => {
      readWisataService.get().then(x => {
        $scope.datas = x;
        var akhir = { lat: parseFloat(x.wisata.lat), lng: parseFloat(x.wisata.long) };
        googleMap = new GoogleMap(12, akhir);
        const contentString =
          '<div id="content">' +
          '<div id="siteNotice">' +
          "</div>" +
          '<h3 id="firstHeading" class="firstHeading">' + x.wisata.nama + '</h3>' +
          '<div id="bodyContent">' +
          '<div class="col-md-12">' +
          '<div class="col-md-4">' +
          '<img id="imgwindowinfo" src="' + $scope.url + '/objekwisata/assets/img/wisata/foto/' + x.wisata.foto + '"></img>' +
          "</div>" +
          '<div class="col-md-8">' +
          "<p>" + x.wisata.alamat + "</p>" +
          "<h5>Biaya Pondok:" + x.wisata.biayapondok + "</h5>" +
          "<h5>Biaya Parkir:" + x.wisata.biayaparkir + "</h5>" +
          "</div>" +
          "</div>" +

          "</div>" +
          "</div>";
        googleMap.setMarker(akhir, x.wisata.nama, x.wisata.icon, null, contentString);
        googleMap.setCurrentPosition();
        $.LoadingOverlay("hide");
      })
    };
    $scope.clear = (event) => {
    }
    $scope.detail = function (pothole) {
      $scope.showdirec = true;
      $scope.tampilgaris = false
      var ll = pothole.latLng;
      $scope.destlat = ll.lat();
      $scope.destlong = ll.lng();

      geocoder.geocode({ 'location': this.getPosition() }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            console.log(results[1]);

          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });

    };
    $scope.show = (item) => {
      $scope.$apply(x => {
        $scope.model.alamat = item.alamat;
        $scope.model.lat = item.location.lat;
        $scope.model.long = item.location.lng;
      })
    }

    $scope.addMarker = function (event) {
      if ($scope.datas.user) {
        var ll = event.latLng;
        $scope.addlat = ll.lat();
        $scope.addlong = ll.lng();
      }
    };
  }
  function wisataController($scope, $http, NgMap, WisataService, helperServices, $sce) {
    $scope.url = helperServices.url;
    $scope.datas = [];
    $scope.model = {};
    
    $scope.fileTitle = "Drag and drop a file";
    let googleMap;
    $scope.convertdate = (item) => {
      return new Date(item);
    }
    $scope.htmltotext =(item)=>{
      return $sce.trustAsHtml(item);
    }
    $scope.Init = () => {
      WisataService.get().then(x => {
        $scope.datas = x;
        var akhir = { lat: parseFloat(-2.542985), lng: parseFloat(140.703467) };
        googleMap = new GoogleMap(12, akhir);
        googleMap.setMarker(akhir, x.nama);
        $scope.datas.wisata.forEach(x => {
          var pos = { lat: parseFloat(x.lat), lng: parseFloat(x.long) };
          const contentString =
            '<div id="content">' +
            '<div id="siteNotice">' +
            "</div>" +
            '<h4 id="firstHeading" class="firstHeading">' + x.nama + '</h4>' +
            '<div id="bodyContent">' +
            '<div class="col-md-12">' +
            '<div class="col-md-4">' +
            '<img id="imgwindowinfo" src="' + $scope.url + '/objekwisata/assets/img/wisata/foto/' + x.foto + '"></img>' +
            "</div>" +
            '<div class="col-md-8">' +
            "<p>" + x.alamat + "</p>" +
            "<h5>Biaya Pondok:" + x.biayapondok + "</h5>" +
            "<h5>Biaya Parkir:" + x.biayaparkir + "</h5>" +
            "</div>" +
            "</div>" +

            "</div>" +
            "</div>";
          googleMap.setMarker(pos, x.nama, x.icon, null, contentString);

        })

        var infoWindow = new google.maps.InfoWindow;
        googleMap.setCurrentPosition();
        googleMap.showdata = $scope.show;
        $.LoadingOverlay("hide");
      })
    };
    $scope.clear = (event) => {
    }
    $scope.detail = function (pothole) {
      $scope.showdirec = true;
      $scope.tampilgaris = false
      var ll = pothole.latLng;
      $scope.destlat = ll.lat();
      $scope.destlong = ll.lng();

      geocoder.geocode({ 'location': this.getPosition() }, function (results, status) {
        if (status === google.maps.GeocoderStatus.OK) {
          if (results[1]) {
            console.log(results[1]);

          } else {
            window.alert('No results found');
          }
        } else {
          window.alert('Geocoder failed due to: ' + status);
        }
      });

    };
    $scope.simpan=()=>{
      $.LoadingOverlay("show", {
        image       : "",
        fontawesome : "fas fa-cog fa-spin"
      });
      var fd = new FormData();
      if ($scope.myFile) {
        var file = $scope.myFile;
        fd.append('file', file[0]);
        for (var prop in $scope.model) {
          fd.append(prop, $scope.model[prop]);
        }
      }
      WisataService.post(fd).then(x=>{
        swal({
          title: "Information",
          text: "Anda berhasil menambahkan marker",
          icon: "success",
          buttons: true,
          dangerMode: false,
        })
        .then((willDelete) => {
          window.location.href = helperServices.url + '/objekwisata/guest/wisata';
          $scope.model = {};
          $.LoadingOverlay("hide");
          $("#addwisata").modal('hide');
        });

      })
    }
    $scope.show = (item) => {
      if ($scope.datas.user) {
        $scope.$apply(x => {
          $scope.model.alamat = item.alamat;
          $scope.model.lat = item.location.lat;
          $scope.model.long = item.location.lng;
        })
        $("#addwisata").modal('show');
      }
    }

    $scope.addMarker = function (event) {
      if ($scope.datas.user) {
        var ll = event.latLng;
        $scope.addlat = ll.lat();
        $scope.addlong = ll.lng();
      }
    };
  }
  function homeController($scope, $http, NgMap, helperServices, HomeService) {
    $scope.datas = [];
    $scope.Wisatas = [];
    var random = [];
    $scope.convertdate = (item) => {
      return new Date(item);
    }
    HomeService.get().then(x => {
      $scope.datas = x;
      random = angular.copy($scope.datas.wisata);

      for (let index = 0; index < 3; index++) {
        var randomItem = random[Math.floor(Math.random() * random.length)];
        $scope.Wisatas.push(angular.copy(randomItem));
        var indexx = random.indexOf(randomItem);
        random.splice(indexx, 1);
      }
      for (let index = 0; index < 4; index++) {
        var randomItem = $scope.datas.wisata[Math.floor(Math.random() * $scope.datas.wisata.length)];
        if (randomItem && index == 0)
          $scope.gambar1 = helperServices.url + "/objekwisata/assets/img/wisata/foto/" + randomItem.foto;
        else if (randomItem && index == 1)
          $scope.gambar2 = helperServices.url + "/objekwisata/assets/img/wisata/foto/" + randomItem.foto;
        else if (randomItem && index == 2)
          $scope.gambar3 = helperServices.url + "/objekwisata/assets/img/wisata/foto/" + randomItem.foto;
        else if (randomItem && index == 3)
          $scope.gambar4 = helperServices.url + "/objekwisata/assets/img/wisata/foto/" + randomItem.foto;
        var indexx = $scope.datas.wisata.indexOf(randomItem);
        $scope.datas.wisata.splice(indexx, 1);
      }
      $.LoadingOverlay("hide");
    })
  }
  function eventController($scope, helperServices, EventService, $sce) {
    $scope.datas = [];
    $scope.Event = [];
    $scope.convertdate = (item) => {
      return new Date(item);
    }
    $scope.htmltotext =(item)=>{
      return $sce.trustAsHtml(item);
    }
    EventService.get().then(x => {
      $scope.datas = x;
      // $scope.datas.forEach(element=>{
      //   element.string = $sce.trustAsHtml(element.isi);
      // })
      $.LoadingOverlay("hide");
    })
  }
  function bukuTamuController($scope, $http, helperServices, BukutamuService) {
    $scope.datas = [];
    $scope.Event = [];
    $scope.model = {};
    $.LoadingOverlay("hide");
    $scope.simpan = () => {
      $.LoadingOverlay("show", {
        image: "",
        background: "rgba(255, 255, 255, 0.75)",
        fontawesome: "fas fa-snowflake fa-spin",
      });
      var url = "https://ipinfo.io/?token=299b1dbfd06d99";
      $http.get(url).then(function(response) {
        console.log(JSON.stringify(response.data));
        $scope.model.location = JSON.stringify(response.data)
        BukutamuService.post($scope.model).then(x=>{
          swal("Information!", "Terima kasih telah mengisi buku tamu", "success");
          $scope.model = {};
          $.LoadingOverlay("hide");
        })
      });
    }
  }
  function readeventController($scope) {
    $.LoadingOverlay("hide");
  }

})(window.angular);



