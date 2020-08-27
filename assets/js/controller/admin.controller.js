(function (angular) {
  'use strict'
  angular.module('ctrlguest', ['data.service', 'helper.service', 'datatables'])
    .controller('kategoriController', kategoriController)
    .controller('wisataController', wisataController)
    .controller('homeController', homeController)
    .controller('addController', addController)
    .controller('bukutamuController', bukutamuController)
    .controller('eventController', eventController)
    .controller('addeventController', addeventController)
    .controller('markingController', markingController)
    .controller('userController', userController);
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
    $scope.kategori = {};
    $scope.fileTitle = "Drag and drop a file";
    wisataService.get().then(x => {
      $scope.datas = x;
      $.LoadingOverlay("hide");

    })
    $scope.simpan = () => {
      $.LoadingOverlay("show", {
        image: "",
        fontawesome: "fas fa-cog fa-spin"
      });
      var fd = new FormData();
      if ($scope.myFile) {
        var file = $scope.myFile;
        fd.append('file', file[0]);
        for (var prop in $scope.model) {
          fd.append(prop, $scope.model[prop]);
        }
      } else {
        for (var prop in $scope.model) {
          fd.append(prop, $scope.model[prop]);
        }
      }
      wisataService.put(fd, $scope.model).then(x => {
        swal({
          title: "information",
          text: "Tambah data Wisata Berhasil",
          icon: "success",

          buttons: true,
          dangerMode: false,
        })
          .then((value) => {
            // window.location.href = helperServices.url + '/objekwisata/admin/wisata';
            $.LoadingOverlay("hide");
          });
      })
    }
    $scope.hapus = () => {
      $.LoadingOverlay("show", {
        image: "",
        fontawesome: "fas fa-cog fa-spin"
      });
      wisataService.delete().then(x => {
        swal("Information!", 'hapus data berhasil', "success");
        $.LoadingOverlay("hide");
      })
    }
    $scope.edit = (item) => {
      $scope.model = angular.copy(item);
      $('#addwisata').modal('show');
      $scope.kategori = $scope.datas.kategori.find(x => x.idkategori_wisata == item.idkategori_wisata);
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
      // googleMap.setMarker(akhir);
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
    $scope.cari = () => {
      googleMap.setMarkercari();
    }
    $scope.simpan = () => {
      // $.LoadingOverlay("show", {
      //   image: "",
      //   fontawesome: "fas fa-cog fa-spin"
      // });
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
              window.location.href = helperServices.url + '/objekwisata/admin/wisata';
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
    homeService.get().then(x => {
      $scope.datas = x;
      var Label = [];
      var Data = [];
      $scope.datas.forEach(element=>{
        Label.push(element.nama);
        Data.push(element.totalwisata);
      })
      var ctx = document.getElementById('myChart').getContext('2d');

      // var Data = [12, 19, 3, 5, 2, 3];
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: Label,
          datasets: [
            {
              label: 'Total Pengajuan',
              data: Data,
              backgroundColor: random_rgba(Data.length)
              // [
              // 	'rgba(255, 99, 132, 0.2)',
              // 	'rgba(54, 162, 235, 0.2)',
              // 	'rgba(255, 206, 86, 0.2)',
              // 	'rgba(75, 192, 192, 0.2)',
              // 	'rgba(153, 102, 255, 0.2)',
              // 	'rgba(255, 159, 64, 0.2)'
              // ],
              // borderColor: [
              // 	'rgba(255, 99, 132, 1)',
              // 	'rgba(54, 162, 235, 1)',
              // 	'rgba(255, 206, 86, 1)',
              // 	'rgba(75, 192, 192, 1)',
              // 	'rgba(153, 102, 255, 1)',
              // 	'rgba(255, 159, 64, 1)'
              // ],
              // borderWidth: 1
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            display: false
          },
          scales: {
            xAxes: [{
              display: true,
              scaleLabel: {
                display: true,
                labelString: 'Kategori Wisata'
              }
            }],
            yAxes: [
              {
                ticks: {
                  beginAtZero: true
                },
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Jumlah Wisata'
                }
              }
            ]
          }
        }
      });
      $.LoadingOverlay("hide");
    });
    var random_rgba = (length) => {
      var color = [];
      for (let index = 0; index < length; index++) {
        var o = Math.round, r = Math.random, s = 255;
        color.push('rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + 0.7 + ')');
      }
      console.log(color);
      return color;
    }
  }
  function bukutamuController($scope, helperServices, bukuTamuService) {
    $scope.datas = [];
    bukuTamuService.get().then(x => {
      x.forEach(element => {
        element.location = JSON.parse(element.location);
        $scope.datas.push(element);
      })
      $.LoadingOverlay("hide");
    })
    $scope.convertdate = (date) => {
      return new Date(date);
    }
  }
  function eventController($scope, helperServices, eventService, $sce) {
    $scope.helper = helperServices.url;
    $scope.datas = [];
    $scope.model = {};
    $scope.myFile;
    $scope.htmltotext = (item) => {
      return $sce.trustAsHtml(item);
    }
    eventService.get().then(x => {
      $scope.datas = x;
      $.LoadingOverlay("hide");
    })
    $scope.simpan = () => {
      $.LoadingOverlay("show", {
        image: "",
        fontawesome: "fas fa-cog fa-spin"
      });
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
          $.LoadingOverlay("hide");
        })
      } else {
        eventService.post(fd).then(x => {
          swal("Information!", 'tambah data berhasil', "success");
          $.LoadingOverlay("hide");
        })
      }
    }
    $scope.hapus = () => {
      $.LoadingOverlay("show", {
        image: "",
        fontawesome: "fas fa-cog fa-spin"
      });
      eventService.delete().then(x => {
        swal("Information!", 'hapus data berhasil', "success");
        $.LoadingOverlay("hide");
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
  function markingController($scope, helperServices, markingService) {
    $scope.datas = [];

    markingService.get().then(x => {
      $scope.datas = x;
      $.LoadingOverlay("hide");
    })
    $scope.ubah = (item) => {
      swal({
        title: "Anda Yakin?",
        text: "Anda akan melakukan perubahan pada data",
        icon: "warning",
        buttons: true,
        dangerMode: false,
      })
        .then((value) => {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          if (value) {
            item.status = 'true';
            markingService.put(item).then(x => {
              swal("Data Berhasil diproses", {
                icon: "success",
              });
              $.LoadingOverlay("hide");
            })
          }
        });
    }
    $scope.hapus = (item) => {
      swal({
        title: "Are you sure?",
        text: "anda tidak dapat mengembalikan data yang telah dihapus!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
        .then((willDelete) => {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          if (willDelete) {
            markingService.delete(item.idwisata).then(x => {
              swal("data berhasil di hapus", {
                icon: "success",
              });
              $.LoadingOverlay("hide");
            })

          }
        });
    }
  }
  function userController($scope, helperServices, userService) {
    $scope.datas = [];
    userService.get().then(x=>{
      $scope.datas = x;
      $.LoadingOverlay("hide");
    })
    $scope.status = (item)=>{
      return item == "Aktif" ? "Aktif" : "Tidak Aktif";
    }
    $scope.ubah = (item)=>{
      swal({
        title: "Anda Yakin?",
        text: "Anda akan melakukan perubahan pada data",
        icon: "warning",
        buttons: true,
        dangerMode: false,
      })
        .then((value) => {
          $.LoadingOverlay("show", {
            image: "",
            fontawesome: "fas fa-cog fa-spin"
          });
          if (value) {
            userService.put(item).then(x => {
              swal("Data Berhasil diproses", {
                icon: "success",
              });
              $.LoadingOverlay("hide");
            })
          }
        });
    }
    
  }
})(window.angular);