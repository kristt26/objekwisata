(function (angular) {
  'use strict'
  angular.module('ctrlguest', ['data.service', 'helper.service', 'datatables'])
    .controller('kategoriController', kategoriController)
    .controller('wisataController', wisataController)
    .controller('homeController', homeController)
    .controller('addController', addController)
    .controller('bukutamuController', bukutamuController)
    .controller('eventController', eventController)
    .controller('addeventController', addeventController);
  function kategoriController($scope, $http, helperServices, kategoriService) {
    $scope.datas = [];
    $scope.model = {};
    kategoriService.get().then(x => {
      $scope.datas = x;
      $.LoadingOverlay("hide");

    })
    $scope.simpan = () => {
      if ($scope.model.idkategori_wisata) {
        kategoriService.put($scope.model).then(x => {
          swal("Information!", 'ubah data berhasil', "success");
        })
      } else {
        kategoriService.post($scope.model).then(x => {
          swal("Information!", 'tambah data berhasil', "success");
        })
      }
    }
    $scope.hapus = () => {
      kategoriService.delete().then(x => {
        swal("Information!", 'hapus data berhasil', "success");
      })
    }
    $scope.edit = (item) => {
      $scope.model = item;
    }
  }

  function wisataController($scope, helperServices, wisataService) {
    $scope.helper = helperServices.url;
    $scope.datas = [];
    $scope.model = {};
    $scope.myFile;
    $scope.fileTitle = "Drag and drop a file";
    wisataService.get().then(x => {
      $scope.datas = x;
      $.LoadingOverlay("hide");

    })
    $scope.simpan = () => {
      var fd = new FormData();
      if ($scope.myFile) {
        var file = $scope.myFile;
        fd.append('file', file[0]);
        for (var prop in $scope.model) {
          fd.append(prop, $scope.model[prop]);
        }
      }
      if ($scope.model.idwisata) {
        wisataService.put(fd).then(x => {
          swal("Information!", 'ubah data berhasil', "success");
        })
      } else {
        wisataService.post(fd).then(x => {
          swal("Information!", 'tambah data berhasil', "success");
        })
      }
    }
    $scope.hapus = () => {
      wisataService.delete().then(x => {
        swal("Information!", 'hapus data berhasil', "success");
      })
    }
    $scope.edit = (item) => {
      $scope.model = item;
    }
  }

  function addController($scope, helperServices, addwisataService) {
    $scope.datas = [];
    $scope.model = {};
    $scope.myFile;
    $scope.fileTitle = "Drag and drop a file";
    $scope.address;
    var akhir = { lat: -2.585888, lng: 140.668497 };
    googleMap = new GoogleMap(12, akhir);
    addwisataService.get().then(x => {
      $scope.datas = x;
      $.LoadingOverlay("hide");

    })
    $scope.Init = () => {
      googleMap.setMarker(akhir);
      googleMap.showdata = $scope.show;
    };

    $scope.show = (item) => {
      $scope.$apply(x => {
        $scope.model.alamat = item.alamat;
        $scope.model.lat = item.location.lat;
        $scope.model.long = item.location.lng;
        $("#addwisata").modal('show');
      })
    }
    $scope.cari=()=>{
      googleMap.setMarkercari();
    }
    $scope.simpan = () => {
      var fd = new FormData();
      if ($scope.myFile) {
        var file = $scope.myFile;
        fd.append('file', file[0]);
        for (var prop in $scope.model) {
          fd.append(prop, $scope.model[prop]);
        }
      }
      if ($scope.model.idwisata) {
        addwisataService.put(fd).then(x => {
          swal({
            title: "information",
            text: "Tambah data Wisata Berhasil",
            icon: "success",
      
            buttons: true,
            dangerMode: false,
          })
            .then((value) => {
              window.location.href = helperServices.url + '/musrembang/admin/wisata';
            });
        })
      } else {
        addwisataService.post(fd).then(x => {
          swal({
            title: "information",
            text: "Ubah data Wisata Berhasil",
            icon: "success",
      
            buttons: true,
            dangerMode: false,
          })
            .then((value) => {
              window.location.href = helperServices.url + '/objekwisata/admin/wisata';
            });
        })
      }
    }
    $scope.hapus = () => {
      addwisataService.delete().then(x => {
        swal("Information!", 'hapus data berhasil', "success");
      })
    }
    $scope.edit = (item) => {
      $scope.model = item;
    }
  }

  function homeController($scope, helperServices, homeService) {
    $scope.datas = [];
    homeService.get().then(x=>{
      $scope.datas = x;
      $.LoadingOverlay("hide");
    })
  }
  function bukutamuController($scope, helperServices, bukuTamuService) {
    $scope.datas = [];
    bukuTamuService.get().then(x=>{
      x.forEach(element=>{
        element.location = JSON.parse(element.location);
        $scope.datas.push(element);
      })
      $.LoadingOverlay("hide");
    })
    $scope.convertdate = (date)=>{
      return new Date(date);
    }
  }
  function eventController($scope, helperServices, eventService, $sce) {
    $scope.helper = helperServices.url;
    $scope.datas = [];
    $scope.model = {};
    $scope.myFile;
    $scope.htmltotext =(item)=>{
      return $sce.trustAsHtml(item);
    }
    eventService.get().then(x => {
      $scope.datas=x;
      $.LoadingOverlay("hide");
    })
    $scope.simpan = () => {
      var fd = new FormData();
      if ($scope.myFile) {
        var file = $scope.myFile;
        fd.append('file', file[0]);
        for (var prop in $scope.model) {
          fd.append(prop, $scope.model[prop]);
        }
      }
      if ($scope.model.idwisata) {
        eventService.put(fd).then(x => {
          swal("Information!", 'ubah data berhasil', "success");
        })
      } else {
        eventService.post(fd).then(x => {
          swal("Information!", 'tambah data berhasil', "success");
        })
      }
    }
    $scope.hapus = () => {
      eventService.delete().then(x => {
        swal("Information!", 'hapus data berhasil', "success");
      })
    }
    $scope.edit = (item) => {
      $scope.model = item;
    }
  }
  function addeventController($scope, helperServices) {
    $scope.datas = [];
    $.LoadingOverlay("hide");
  }
})(window.angular);