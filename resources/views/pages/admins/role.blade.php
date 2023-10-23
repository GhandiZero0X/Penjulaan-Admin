@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Role</h4>
                <button id="addRoleButton" class="btn btn-success btn-sm rounded">
                    <i class="typcn typcn-plus"></i> Tambah Role
                </button>
                <div class="card-body border p-3" id="createRoleForm"
                    style="display: none; margin-top: 10px; background-color: #fffefe; max-width: 50%; border-radius: 5px; border: 10px solid #000;">
                    <h3 class="card-title">Tambah Role Baru</h3>
                    <form id="roleForm" action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="form-group d-flex">
                            <label for="nama_role" class="mr-2">Nama Role</label>
                            <input type="text" class="form-control bold" id="nama_role" name="nama_role"
                                style="width: 60%; height: 20px;">
                            <button type="submit" class="btn btn-success btn-sm ml-4" style="width: auto;">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="table-responsive pt-3" style="max-width: 70%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Role</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->idrole }}</td>
                                    <td>{{ $role->nama_role }}</td>
                                    <td>{{ $role->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}</td>
                                    <td style="text-align: center;">
                                        <button href="javascript:void(0);" data-id="{{ $role->idrole }}"
                                            class="btn btn-warning btn-sm mr-2 editRole">
                                            <i class="typcn typcn-pencil"></i> Edit
                                        </button>
                                        <button href="javascript:void(0);" data-id="{{ $role->idrole }}"
                                            class="btn btn-danger btn-sm deleteRole">
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

    <!-- Formulir Edit Role -->

        <div class="card-body border p-3 " id="editRoleFormRow" style="display: none;">
            <form id="editRoleForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="edit_role_id" id="edit_role_id" value="">
                <div class="form-group">
                    <label for="edit_nama_role">Nama Role</label>
                    <input type="text" class="form-control" name="edit_nama_role" id="edit_nama_role">
                </div>
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-success btn-sm mr-2">Simpan</button>
                    <button type="button" id="cancelEditRole" class="btn btn-secondary btn-sm">Batal</button>
                </div>
            </form>
        </div>

    
    <!-- Tambahkan modal tambah dan modal edit di sini -->
@endsection


<!-- Include JavaScript library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Tombol "Tambah" diklik
        $('#addRoleButton').click(function() {
            let btn = $('#addRoleButton');
            let form = $('#createRoleForm');

            if (form.is(':visible')) {
                form.slideUp();
            } else {
                form.slideDown();
            }
        });

        // Form disubmit
        $('#roleForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Kirim data form ke server melalui AJAX
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Sembunyikan form
                    $('#createRoleForm').slideUp();

                    if (response.error) {
                        alert('Error: ' + response
                            .error); // Tampilkan pesan kesalahan jika ada masalah
                    } else {
                        // Tambahkan role baru ke daftar jika berhasil disimpan
                        var newRow = '<tr>';
                        newRow += '<td>' + response.idrole + '</td>';
                        newRow += '<td>' + response.nama_role + '</td>';
                        newRow += '<td>Aktif</td>'; // Default status aktif
                        newRow += '<td style="text-align: center;">';
                        newRow += '<a href="javascript:void(0);" data-id="' + response
                            .idrole +
                            '" class="btn btn-warning btn-sm mr-2 editRole"><i class="typcn typcn-pencil"></i> Edit</a>';
                        newRow += '<a href="javascript:void(0);" data-id="' + response
                            .idrole +
                            '" class="btn btn-danger btn-sm deleteRole"><i class="typcn typcn-trash"></i> Hapus</a>';
                        newRow += '</td></tr>';
                        $('table tbody').append(newRow);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal menambahkan role. Silakan coba lagi.');
                }
            });
        });
    });

    $(document).ready(function() {
        $('.deleteRole').click(function() {
            var deleteButton = $(this);
            var roleId = deleteButton.data('id');

            // Tampilkan konfirmasi
            if (confirm('Apakah Anda yakin ingin menghapus role ini?')) {
                // Hapus baris yang berkaitan dari tabel
                deleteButton.closest('tr').remove();

                // Lakukan permintaan AJAX untuk melakukan soft delete
                $.ajax({
                    url: '/roles/' + roleId + '/softdelete',
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Tampilkan pesan sukses atau lakukan tindakan lain setelah berhasil dihapus
                        alert('Role berhasil dihapus (soft delete).');
                        // location.reload(); // Memuat ulang halaman
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Gagal menghapus role. Silakan coba lagi.');
                    }
                });
            }
        });
    });

    $(document).ready(function() {
        // Tombol "Edit" diklik
        $('.editRole').click(function() {
            var roleId = $(this).data('id');
            var roleName = $(this).closest('tr').find('td:nth-child(2)').text();

            // Isi formulir edit dengan data yang ada
            $('#edit_role_id').val(roleId);
            $('#edit_nama_role').val(roleName);

            // Sembunyikan tombol "Edit" dan tampilkan tombol "Batal"
            $(this).hide();
            $(this).siblings('.deleteRole').hide();
            $(this).closest('tr').after($('#editRoleFormRow'));

            // Tampilkan formulir edit dengan animasi slide
            $('#editRoleFormRow').slideDown();
        });

        // Tombol "Batal" diklik
        $('#cancelEditRole').click(function() {
            // Sembunyikan formulir edit dan tampilkan kembali tombol "Edit" dan "Hapus"
            $('#editRoleFormRow').slideUp(function() {
                $(this).prev('tr').find('.editRole').show();
                $(this).prev('tr').find('.deleteRole').show();
            });
        });

        // Form disubmit
        $('#editRoleForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var roleId = $('#edit_role_id').val();

            $.ajax({
                url: '/roles/' + roleId,
                type: 'PUT',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Hide the form and show "Edit" and "Delete" buttons
                    $('#editRoleFormRow').slideUp(function() {
                        $(this).prev('tr').find('.editRole').show();
                        $(this).prev('tr').find('.deleteRole').show();
                    });

                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        // Update the role name in the table
                        $('td[data-role-id="' + roleId + '"]').text(response.nama_role);

                        // Auto-reload the page after a successful update
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal memperbarui role. Silakan coba lagi.');
                }
            });
        });
    });
</script>
