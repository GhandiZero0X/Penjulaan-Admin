@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Satuan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <button id="addSatuanButton" class="btn btn-success btn-sm rounded">
                            <i class="typcn typcn-plus"></i> Tambah Satuan
                        </button>
                    </div>
                    <div class="col-md-6">
                        <button id="historyDeleteButton" class="btn btn-danger btn-sm rounded float-right">
                            <i class="typcn typcn-history"></i> History Hapus
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body border p-3" id="createSatuanForm"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title">Tambah Satuan Baru</h3>
                            <form id="satuanForm" action="{{ route('satuans.store') }}" method="POST">
                                @csrf
                                <div class="form-group d-flex">
                                    <label for="nama_satuan" class="mr-2">Satuan</label>
                                    <input type="text" class="form-control bold" id="nama_satuan" name="nama_satuan"
                                        style="width: 60%; height: 20px;">
                                    <button type="submit" class="btn btn-success btn-sm ml-4"
                                        style="width: auto;">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body border p-3" id="tampil-history-hapus"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title" id="historyDeleteModalLabel">History Hapus Satuan</h3>

                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Nama Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="softDeletedSatuans" style="text-align: center;">
                                    {{-- isinya memakai jquery yang di buat --}}
                                </tbody>
                            </table>

                            <button type="button" class="btn btn-sm btn-secondary mt-2" data-dismiss="modal"
                                style="width: auto; text-align: center;">Tutup</button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive pt-3" style="max-width: 70%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Nama Satuan</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($satuans as $satuan)
                                <tr style="text-align: center;">
                                    <td>{{ $satuan->idsatuan }}</td>
                                    <td>{{ $satuan->nama_satuan }}</td>
                                    <td>{{ $satuan->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}</td>
                                    <td style="text-align: center;">
                                        <button href="javascript:void(0);" data-id="{{ $satuan->idsatuan }}"
                                            class="btn btn-warning btn-sm mr-2 editSatuan">
                                            <i class="typcn typcn-pencil"></i> Edit
                                        </button>
                                        <button href="javascript:void(0);" data-id="{{ $satuan->idsatuan }}"
                                            class="btn btn-danger btn-sm deleteSatuan">
                                            <i class="typcn typcn-trash"></i> Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body border p-3 " id="editSatuanFormRow" style="display: none;">
        <form id="editSatuanForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="edit_satuan_id" id="edit_satuan_id" value="">
            <div class="form-group">
                <label for="edit_nama_satuan">Nama Satuan</label>
                <input type="text" class="form-control" name="edit_nama_satuan" id="edit_nama_satuan">
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success btn-sm mr-2">Simpan</button>
                <button type="button" id="cancelEditSatuan" class="btn btn-secondary btn-sm">Batal</button>
            </div>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#addSatuanButton').click(function() {
            let btn = $('#addSatuanButton');
            let form = $('#createSatuanForm');

            if (form.is(':visible')) {
                form.slideUp();
            } else {
                form.slideDown();
            }
        });

        $('#satuanForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#createSatuanForm').slideUp();

                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        // Add the new Satuan to the table if it was successfully saved
                        var newRow = '<tr>';
                        newRow += '<td>' + response.idsatuan + '</td>';
                        newRow += '<td>' + response.nama_satuan + '</td>';
                        newRow += '<td>Aktif</td>'; // Default status
                        newRow += '<td style="text-align: center;">';
                        newRow += '<button href="javascript:void(0);" data-id="' + response
                            .idsatuan +
                            '" class="btn btn-warning btn-sm mr-2 editSatuan"><i class="typcn typcn-pencil"></i> Edit</button>';
                        newRow += '<button href="javascript:void(0);" data-id="' + response
                            .idsatuan +
                            '" class="btn btn-danger btn-sm deleteSatuan"><i class="typcn typcn-trash"></i> Hapus</button>';
                        newRow += '</td></tr>';
                        $('table tbody').append(newRow);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to add Satuan. Please try again.');
                }
            });
        });

        $('.deleteSatuan').click(function() {
            var deleteButton = $(this);
            var satuanId = deleteButton.data('id');

            if (confirm('Are you sure you want to delete this Satuan?')) {
                deleteButton.closest('tr').remove();
                $.ajax({
                    url: '/satuans/' + satuanId + '/softdelete',
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert('Satuan deleted (soft delete) successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Failed to delete Satuan. Please try again.');
                    }
                });
            }
        });

        $('.editSatuan').click(function() {
            var satuanId = $(this).data('id');
            var satuanName = $(this).closest('tr').find('td:nth-child(2)').text();

            $('#edit_satuan_id').val(satuanId);
            $('#edit_nama_satuan').val(satuanName);

            $(this).hide();
            $(this).siblings('.deleteSatuan').hide();
            $(this).closest('tr').after($('#editSatuanFormRow'));

            $('#editSatuanFormRow').slideDown();
        });

        $('#cancelEditSatuan').click(function() {
            $('#editSatuanFormRow').slideUp(function() {
                $(this).prev('tr').find('.editSatuan').show();
                $(this).prev('tr').find('.deleteSatuan').show();
            });
        });

        $('#editSatuanForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var satuanId = $('#edit_satuan_id').val();
            $.ajax({
                url: '/satuans/' + satuanId,
                type: 'PUT',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#editSatuanFormRow').slideUp(function() {
                        $(this).prev('tr').find('.editSatuan').show();
                        $(this).prev('tr').find('.deleteSatuan').show();
                    });
                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        $('td[data-satuan-id="' + satuanId + '"]').text(response
                            .nama_satuan);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to edit Satuan. Please try again.');
                }
            });
        });

        $('#historyDeleteButton').click(function() {
            $('#softDeletedSatuans').empty();
            $.ajax({
                url: '/soft-deleted-satuans',
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(function(satuan) {
                            var row = '<tr>' +
                                '<td>' + satuan.nama_satuan + '</td>' +
                                '<td><button data-id="' + satuan.idsatuan +
                                '" class="btn btn-sm btn-success restoreSatuan">Pulihkan</button></td>' +
                                '</tr>';
                            $('#softDeletedSatuans').append(row);
                        });
                        $('#softDeletedSatuans').slideDown();
                        $('#tampil-history-hapus').slideDown();
                    } else {
                        alert('No soft-deleted Satuan entries found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert(
                        'Failed to retrieve soft-deleted Satuan entries. Please try again.'
                        );
                }
            });
        });

        $('#tampil-history-hapus .btn-secondary').click(function() {
            $('#softDeletedSatuans').slideUp();
            $('#tampil-history-hapus').slideUp();
        });

        $(document).on('click', '.restoreSatuan', function() {
            var satuanId = $(this).data('id');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('satuan.restore', ':id') }}'.replace(':id', satuanId),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.message) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Failed to restore Satuan.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to restore Satuan. Please try again.');
                }
            });
        });
    });
</script>
