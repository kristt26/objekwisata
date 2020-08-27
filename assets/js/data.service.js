angular
	.module('data.service', ['helper.service'])
	.factory('kategoriService', kategoriService)
	.factory('wisataService', wisataService)
	.factory('addwisataService', addwisataService)
	.factory('homeService', homeService)
	.factory('bukuTamuService', bukuTamuService)
	.factory('eventService', eventService)
	.factory('markingService', markingService)
	.factory('userService', userService);

function kategoriService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/kategori/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.instance = true;
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	service.post = function (item) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'tambah',
			headers: {
				'Content-Type': 'application/json'
			},
			data: item
		}).then(
			(response) => {
				service.instance = true;
				service.Items.push(response.data);
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.put = function (item) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'ubah',
			headers: {
				'Content-Type': 'application/json'
			},
			data: item
		}).then(
			(response) => {
				service.instance = true;
				service.Items = response.data;
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x => x.idkategori_wisata == id);
				var index = service.Items.indexOf(data);
				service.Items.splice(index, 1);
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.upload = function (param) {
		var def = $q.defer();
		var fd = new FormData();
		fd.append('file', param[0]);
		$http({
			method: 'POST',
			url: url + 'upload',
			headers: {
				'Content-Type': undefined
			},
			data: fd
		}).then(
			(response) => {
				service.Items.logo = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}
function wisataService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/wisata/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.instance = true;
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	service.put = function (item, param) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'ubah',
			headers: {
				'Content-Type': undefined
			},
			data: item
		}).then(
			(response) => {
				service.instance = true;
				var data;
				service.Items.wisata.forEach(element=>{
					var a = element.wisata.find(x=>x.idwisata==param.idwisata);
					if(a)
						data = a;
				});
				data.nama=response.data.nama;
				data.alamat = response.data.alamat;
				data.keterangan = response.data.keterangan;
				data.biayaparkir = response.data.biayaparkir;
				data.biayapondok = response.data.biayapondok;
				data.idkategori_wisata = response.data.idkategori_wisata;
				data.foto = response.data.foto;
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x => x.idkategori_wisata == id);
				var index = service.Items.indexOf(data);
				service.Items.splice(index, 1);
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.upload = function (param) {
		var def = $q.defer();
		var fd = new FormData();
		fd.append('file', param[0]);
		$http({
			method: 'POST',
			url: url + 'upload',
			headers: {
				'Content-Type': undefined
			},
			data: fd
		}).then(
			(response) => {
				service.Items.logo = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}
function addwisataService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/addwisata/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.instance = true;
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	service.post = function (item) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'tambah',
			headers: {
				'Content-Type': undefined
			},
			data: item
		}).then(
			(response) => {
				service.instance = true;
				service.Items = response.data;
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.put = function (item) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'ubah',
			headers: {
				'Content-Type': undefined
			},
			data: item
		}).then(
			(response) => {
				service.instance = true;
				service.Items = response.data;
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x => x.idkategori_wisata == id);
				var index = service.Items.indexOf(data);
				service.Items.splice(index, 1);
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.upload = function (param) {
		var def = $q.defer();
		var fd = new FormData();
		fd.append('file', param[0]);
		$http({
			method: 'POST',
			url: url + 'upload',
			headers: {
				'Content-Type': undefined
			},
			data: fd
		}).then(
			(response) => {
				service.Items.logo = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}
function homeService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/home/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	return service;
}
function bukuTamuService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/tamu/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	return service;
}
function eventService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/event/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.instance = true;
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	service.post = function (item) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
			headers: {
				'Content-Type': undefined
			},
			data: param
		}).then(
			(response) => {
				service.instance = true;
				service.Items = response.data;
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.put = function (item) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'ubah',
			headers: {
				'Content-Type': 'application/json'
			},
			data: item
		}).then(
			(response) => {
				service.instance = true;
				service.Items = response.data;
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'delete',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x => x.idkategori_wisata == id);
				var index = service.Items.indexOf(data);
				service.Items.splice(index, 1);
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};

	service.upload = function (param) {
		var def = $q.defer();
		var fd = new FormData();
		fd.append('file', param[0]);
		$http({
			method: 'POST',
			url: url + 'upload',
			headers: {
				'Content-Type': undefined
			},
			data: fd
		}).then(
			(response) => {
				service.Items.logo = response.data;
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "success");
				def.reject(err);
			}
		);

		return def.promise;
	};
	return service;
}
function markingService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/marking/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.instance = true;
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	service.put = function (param) {
		var def = $q.defer();
		$http({
			method: 'PUT',
			url: url + 'ubah',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x => x.idmarking == param.idmarking);
				if (param.status == 'false') {
					data.status == "false"
				} else {
					var index = service.Items.indexOf(data);
					service.Items.splice(index, 1);
				}
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	service.delete = function (id) {
		var def = $q.defer();
		$http({
			method: 'DELETE',
			url: url + 'hapus/' + id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x => x.idwisata ==id);
				var index = service.Items.indexOf(data);
				service.Items.splice(index, 1);
				def.resolve(service.Items);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}
function userService($http, $q, helperServices) {
	var url = helperServices.url + '/objekwisata/admin/user/';
	var service = {
		Items: []
	};
	service.get = function () {
		var def = $q.defer();
		if (service.instance) {
			def.resolve(service.Items);
		} else {
			$http({
				method: 'GET',
				url: url + 'getdata',
				headers: {
					'Content-Type': 'application/json'
				}
			}).then(
				(response) => {
					service.instance = true;
					service.Items = response.data;
					def.resolve(service.Items);
				},
				(err) => {
					swal("Information!", err.data, "error");
					def.reject(err);
				}
			);
		}
		return def.promise;
	};
	service.put = function (param) {
		var def = $q.defer();
		$http({
			method: 'PUT',
			url: url + 'ubah',
			headers: {
				'Content-Type': 'application/json'
			},
			data: param
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x => x.iduser == param.iduser);
				data.status = param.status=="Aktif" ? "Pending": "Aktif";
				def.resolve(response.data);
			},
			(err) => {
				swal("Information!", err.data, "error");
				def.reject(err);
			}
		);
		return def.promise;
	};
	return service;
}