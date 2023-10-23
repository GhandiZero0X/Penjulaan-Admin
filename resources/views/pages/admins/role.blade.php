@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Role</h4>
                <div class="row">
                    <div class="col-md-6">
                        <button id="addRoleButton" class="btn btn-success btn-sm rounded">
                            <i class="typcn typcn-plus"></i> Tambah Role
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
                        <div class="card-body border p-3" id="createRoleForm"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
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
                    </div>
                    <div class="col-md-6">
                        <div class="card-body border p-3" id="tampil-history-hapus"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title" id="historyDeleteModalLabel">History Hapus Role</h3>

                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Nama Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="softDeletedRoles">
                                    <!-- Isi akan ditambahkan melalui JavaScript -->
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
                            <tr>
                                <th>ID</th>
                                <th>Nama Role</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- menampilkan isi tabel role --}}
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

    <!-- Form Edit Role -->
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
                        alert('Error: ' + response.error);
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

        // Delete Role
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

        // Update Role
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

    $(document).ready(function() {
        // History Hapus
        $('#historyDeleteButton').click(function() {
            // Bersihkan daftar "softDeletedRoles" sebelum menambahkan yang baru
            $('#softDeletedRoles').empty();

            // Ambil data role yang dihapus secara lunak dari server (misalnya melalui Ajax)
            $.ajax({
                url: '/soft-deleted-roles',
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(function(role) {
                            var row = '<tr>' +
                                '<td>' + role.nama_role + '</td>' +
                                '<td><button data-id="' + role.idrole +
                                '" class="btn btn-sm btn-success restoreRole">Pulihkan</button></td>' +
                                '</tr>';
                            $('#softDeletedRoles').append(row);
                        });

                        // Animasikan efek slide ke bawah
                        $('#softDeletedRoles').slideDown();

                        // Aktifkan card dengan efek slide ke bawah
                        $('#tampil-history-hapus').slideDown(); // Menampilkan card
                    } else {
                        alert('Tidak ada role yang dihapus secara lunak.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal mengambil data history hapus role. Silakan coba lagi.');
                }
            });
        });

        // Menutup list history hapus role
        $('#tampil-history-hapus .btn-secondary').click(function() {
            $('#softDeletedRoles').slideUp(); // Efek slide ke atas
            $('#tampil-history-hapus').slideUp(); // Efek slide ke atas
        });

        // Update Pulihkan Role
        $(document).on('click', '.restoreRole', function() {
            var roleId = $(this).data('id');

            // Mendapatkan _token CSRF dari meta-tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Lakukan pemulihan role (misalnya melalui Ajax) dengan menyertakan _token CSRF
            $.ajax({
                url: '{{ route('role.restore', ':id') }}'.replace(':id', roleId),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Sertakan _token CSRF dalam header
                },
                success: function(response) {
                    if (response.message) {
                        alert(response.message);
                        // Refresh halaman setelah pemulihan berhasil
                        location.reload();
                    } else {
                        alert('Gagal memulihkan role.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal memulihkan role. Silakan coba lagi.');
                }
            });
        });
    });
</script>
