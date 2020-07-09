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
$(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    // $('.textarea').wysihtml5()
})
$(function () {
    //Initialize Select2 Elements
    // $('.select2').select2()

    //Datemask dd/mm/yyyy
    // $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    // $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    // $('[data-mask]').inputmask()

    //Date range picker
    // $('#reservation').daterangepicker()
    //Date range picker with time picker
    // $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' } })
    //Date range as a button
    // $('#daterange-btn').daterangepicker(
    //     {
    //         ranges: {
    //             'Today': [moment(), moment()],
    //             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //             'This Month': [moment().startOf('month'), moment().endOf('month')],
    //             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    //         },
    //         startDate: moment().subtract(29, 'days'),
    //         endDate: moment()
    //     },
    //     function (start, end) {
    //         $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    //     }
    // )

    //Date picker
    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
    $('.datepicker').datepicker({
        autoclose: true,
    });
    $('#datepicker1').datepicker({
        autoclose: true
    })
    $('#datepicker2').datepicker({
        autoclose: true
    })

    //iCheck for checkbox and radio inputs
    // $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    //     checkboxClass: 'icheckbox_minimal-blue',
    //     radioClass: 'iradio_minimal-blue'
    // })
    //Red color scheme for iCheck
    // $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    //     checkboxClass: 'icheckbox_minimal-red',
    //     radioClass: 'iradio_minimal-red'
    // })
    //Flat red color scheme for iCheck
    // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    //     checkboxClass: 'icheckbox_flat-green',
    //     radioClass: 'iradio_flat-green'
    // })

    //Colorpicker
    // $('.my-colorpicker1').colorpicker()
    //color picker with addon
    // $('.my-colorpicker2').colorpicker()

    //Timepicker
    // $('.timepicker').timepicker({
    //     showInputs: false
    // })
})
