$(function () {
    $(document).ready(function () {
        var data = $('.data-flush').data('flash');
        console.log(data);
        if (data) {
            var a = data.split(',');
            if (a[1].replace(/\s/g, '') == 'success') {
                swal("Information!", a[0], "success");
            } else {
                swal("Information!", a[0], "error");
            }

        }
    })
})

$(function () {
    $(document).ready(function () {
        // get Edit Product
        $('.btn-edit').on('click', function () {
            // get data from button edit
            const nama = $(this).data('nama');
            const idkategori = $(this).data('idkategori');
            // Set data to Form Edit
            $('.edit-nama').val(nama);
            $('.edit-kategori').val(idkategori);
            // Call Modal Edit
            $('#edit-data').modal('show');
        });

        $('.btn-edit-wisata').on('click', function () {
            $('.idwisata').val($(this).data('idwisata'));
            $('.nama').val($(this).data('nama'));
            $('.alamat').val($(this).data('alamat'));
            $('.keterangan').val($(this).data('keterangan'));
            $('.long').val($(this).data('long'));
            $('.lat').val($(this).data('lat'));
            // Call Modal Edit
            $('#edit-data').modal('show');
        });


        // get Delete Product
        $('.btn-delete').on('click', function () {
            // get data from button edit
            const id = $(this).data('id');
            const Url = $(this).data('url');
            // Set data to Form Edit
            // $('.edit-kategori').val(idkategori);
            swal({
                title: "Anda Yakin?",
                text: "Akan Melakukan Penghapusan data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: Url,
                            data: { 'id': id },
                            success: function (data) {
                                swal("Information!", "Berhasil di Hapus", "success")
                                    .then((value) => {
                                        location.reload();
                                    });

                            }
                        });
                    }
                });
        });

        $('.btn-delete-wisata').on('click', function () {
            // get data from button edit
            const id = $(this).data('id');
            const Url = $(this).data('url');
            // Set data to Form Edit
            // $('.edit-kategori').val(idkategori);
            swal({
                title: "Anda Yakin?",
                text: "Akan Melakukan Penghapusan data?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'POST',
                            url: Url,
                            data: { 'id': id },
                            success: function (data) {
                                swal("Information!", "Berhasil di Hapus", "success")
                                    .then((value) => {
                                        location.reload();
                                    });
                            }
                        });
                    }
                });
        });
    });
})


$(document).ready(function () {
    $('#kategori').change(function () {
        var id = $(this).val();
        const Url = $(this).data('url');

        $.ajax({
            type: 'POST',
            url: Url,
            data: { 'id': id },
            success: function (data) {
                const main = document.getElementById('tabledata');
                data = JSON.parse(data);
                var html = '';
                data.forEach(element => {
                    html += "<tr><td>" + element.nama + "</td> <td>" + element.alamat + "</td> <td>" + element.keterangan + "</td> <td>" + element.long + "</td> <td>" + element.lat + "</td> <td><button class='btn btn-default btn-edit' data-wisata=" + element.idwisata + "><i class='fa fa-edit'></i></button>"
                    // <button
                    // class="btn btn-danger btn-delete" data-id="<?= $value['idkategori_wisata'];?>" data-url="<?php echo base_url();?>admin/kategori/hapus"><i class="fa fa-recycle"></i></button>' + element.alamat + '</td> </tr>';
                });
                main.innerHTML = html;
                // $('#tabledata').html(html);
                console.log(html);
            }
        });
        return false;
    });

});
