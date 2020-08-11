(function (angular) {
  'use strict'
  angular.module('ctrlguest', ['ngMap', 'userdata.service', 'helper.service'])
    .controller('readwisataController', function ($scope, $http, NgMap, readWisataService, helperServices) {
      $scope.url = helperServices.url;
      $scope.datas = []
      $scope.heading = 90;
      $scope.pitch = 0;
      $scope.classmap = 'col-xs-12';
      $scope.classpannel;
      $scope.destlat;
      $scope.destlong;

      $scope.map;
      $scope.Init = () => {
        readWisataService.get().then(x => {
          $scope.datas = x;
          $scope.lat = parseFloat($scope.datas.wisata.lat);
          $scope.long = parseFloat($scope.datas.wisata.long);
        })
        var options = {
          enableHighAccuracy: true
        };

        navigator.geolocation.getCurrentPosition(function (pos) {
          $scope.position = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
          // $scope.poss = JSON.stringify($scope.position);
          // $scope.poss = JSON.parse($scope.poss);
          $scope.curentlat = $scope.position.lat();
          $scope.curentlong = $scope.position.lng();

          // alert(JSON.stringify($scope.position));
        },
          function (error) {
            alert('Unable to get location: ' + error.message);
          }, options);
      };
      $scope.clear = ()=>{
        $scope.destlat = null;
        $scope.destlong= null;
        $scope.classmap = 'col-xs-12';
        $scope.classpannel;
      }
      $scope.detail = function (pothole) {
        
        var ll = pothole.latLng;
        $scope.dellat = ll.lat();
        $scope.dellong = ll.lng();
        var infowindow = new google.maps.InfoWindow();
        var center = new google.maps.LatLng($scope.dellat, $scope.dellong);

        infowindow.setContent(
          '<h4>' + $scope.datas.wisata.nama+'</h4><br><a href=""><i class="fas fa-map-marker"></i>Biaya Masuk: 500000</a>');

        infowindow.setPosition(center);
        infowindow.open($scope.map);
      };
      $scope.addMarker = function (event) {
        if($scope.datas.user){
          var ll = event.latLng;
          $scope.addlat = ll.lat();
          $scope.addlong = ll.lng();
        }
      };
    });

})(window.angular);