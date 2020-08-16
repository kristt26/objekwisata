angular
	.module('data.service', ['helper.service'])
	.factory('kategoriService', kategoriService)
	.factory('wisataService', wisataService)
	.factory('addwisataService', addwisataService)
	.factory('homeService', homeService)
	.factory('bukuTamuService', bukuTamuService)
	.factory('eventService', eventService);

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
			url: url + 'hapus/'+id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x=>x.idkategori_wisata==id);
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
	service.post = function (item) {
		var def = $q.defer();
		$http({
			method: 'POST',
			url: url + 'simpan',
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
			url: url + 'hapus/'+id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x=>x.idkategori_wisata==id);
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
	var url = helperServices.url + '/objekwisata/admin/tambahwisata/';
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
			url: url + 'hapus/'+id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x=>x.idkategori_wisata==id);
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
	var url = helperServices.url + '/objekwisata/admin/bukutamu/';
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
			url: url + 'hapus/'+id,
			headers: {
				'Content-Type': 'application/json'
			}
		}).then(
			(response) => {
				service.instance = true;
				var data = service.Items.find(x=>x.idkategori_wisata==id);
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