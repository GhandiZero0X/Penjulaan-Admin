@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar User</h4>
                <div class="row">
                    <div class="col-md-6">
                        <button id="addUserButton" class="btn btn-success btn-sm rounded">
                            <i class="typcn typcn-plus"></i> Tambah User
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
                        <div class="card-body border p-3" id="createUserForm"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title">Tambah User Baru</h3>
                            <form id="userForm" action="{{ route('user.create') }}" method="POST">
                                @csrf
                                <div class="form-group d-flex">
                                    <label for="username" class="mr-2">Nama</label>
                                    <input type="text" class="form-control bold" id="username" name="username"
                                        style="width: 60%; height: 20px;">
                                    <button type="submit" class="btn btn-success btn-sm ml-4"
                                        style="width: auto;">Simpan</button>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="idrole" class="mr-2">Role</label>
                                    <select class="form-control" id="idrole" name="idrole" style="width: 60%;">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="password" class="mr-2">Password</label>
                                    <input type="text" class="form-control bold" id="password" name="password"
                                        style="width: 60%; height: 20px;">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body border p-3" id="tampil-history-hapus"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title" id="historyDeleteModalLabel">History Hapus Supplier</h3>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Nama User</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="softDeletedUsers" style="text-align: center;">
                                    {{-- isinya memakai jquery yang di buat --}}
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-sm btn-secondary mt-2" data-dismiss="modal"
                                style="width: auto; text-align: center;">Tutup</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive pt-3" style="max-width: 80%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Nama User</th>
                                <th>Role</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td style="text-align: center;">{{ $user->iduser }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->nama_role }}</td>
                                    <td style="text-align: center;">{{ $user->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}</td>
                                    <td style="text-align: center;">
                                        <button data-id="{{ $user->iduser }}" class="btn btn-warning btn-sm editUser">
                                            <i class="typcn typcn-pencil"></i> Edit
                                        </button>
                                        <button data-id="{{ $user->iduser }}" class="btn btn-danger btn-sm deleteUser">
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
    <div class="card-body border p-3" id="editUserFormRow" style="display: none;">
        <form id="editUserForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="edit_user_id" id="edit_user_id" value="">
            <div class="form-group">
                <label for="edit_username">Nama User</label>
                <input type="text" class="form-control" name="edit_username" id="edit_username">
            </div>
            <div class="form-group">
                <label for="edit_idrole">Role</label>
                <select class="form-control" name="edit_idrole" id="edit_idrole">
                    @foreach ($roles as $role)
                        <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                    @endforeach
                </select>
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success btn-sm mr-2">Simpan</button>
                <button type="button" id="cancelEditUser" class="btn btn-secondary btn-sm">Batal</button>
            </div>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addUserButton').click(function() {
            let form = $('#createUserForm');

            if (form.is(':visible')) {
                form.slideUp();
            } else {
                form.slideDown();
            }
        });

        $('#userForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#createUserForm').slideUp();

                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        var newRow = '<tr>';
                        newRow += '<td>' + response.iduser + '</td>';
                        newRow += '<td>' + response.username + '</td>';
                        newRow += '<td>' + response.nama_role + '</td>';
                        newRow += '<td>Aktif</td>';
                        newRow += '<td style="text-align: center;">';
                        newRow += '<button data-id="' + response.iduser +
                            '" class="btn btn-warning btn-sm editUser"><i class="typcn typcn-pencil"></i> Edit</button>';
                        newRow += '<button data-id="' + response.iduser +
                            '" class="btn btn-danger btn-sm deleteUser"><i class="typcn typcn-trash"></i> Hapus</button>';
                        newRow += '</td></tr>';
                        $('table tbody').append(newRow);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal menambahkan user. Silakan coba lagi.');
                }
            });
        });

        $('table').on('click', '.deleteUser', function() {
            var deleteButton = $(this);
            var userId = deleteButton.data('id');

            if (confirm('Are you sure you want to delete this User?')) {
                deleteButton.closest('tr').remove();

                $.ajax({
                    url: '/users/' + userId + '/softdelete',
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert('User deleted (soft delete) successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Failed to delete User. Please try again.');
                    }
                });
            }
        });

        $('table').on('click', '.editUser', function() {
            var userId = $(this).data('id');
            var userName = $(this).closest('tr').find('td:nth-child(2)').text();

            $('#edit_user_id').val(userId);
            $('#edit_username').val(userName);

            $(this).hide();
            $(this).closest('tr').after($('#editUserFormRow'));

            $('#editUserFormRow').slideDown();
        });

        $('#cancelEditUser').click(function() {
            $('#editUserFormRow').slideUp(function() {
                $(this).prev('tr').find('.editUser').show();
            });
        });

        $('#editUserForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var userId = $('#edit_user_id').val();
            $.ajax({
                url: '/users/' + userId,
                type: 'PUT',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#editUserFormRow').slideUp(function() {
                        $(this).prev('tr').find('.editUser').show();
                    });

                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        $('td[data-user-id="' + userId + '"]').text(response.username);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to edit User. Please try again.');
                }
            });
        });

        $('#historyDeleteButton').click(function() {
            $('#softDeletedUsers').empty();
            $.ajax({
                url: '/soft-deleted-users',
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(function(user) {
                            var row = '<tr>' +
                                '<td>' + user.username + '</td>' +
                                '<td>' + user.nama_role + '</td>' +
                                '<td><button data-id="' + user.iduser +
                                '" class="btn btn-sm btn-success restoreUser">Pulihkan</button></td>' +
                                '</tr>';
                            $('#softDeletedUsers').append(row);
                        });
                        $('#softDeletedUsers').slideDown();
                        $('#tampil-history-hapus').slideDown();
                    } else {
                        alert('Tidak ada user yang dihapus secara lunak.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal mengambil data history hapus user. Silakan coba lagi.');
                }
            });
        });

        $('#tampil-history-hapus .btn-secondary').click(function() {
            $('#softDeletedUsers').slideUp();
            $('#tampil-history-hapus').slideUp();
        });

        $(document).on('click', '.restoreUser', function() {
            var userId = $(this).data('id');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('user.restore', ':id') }}'.replace(':id', userId),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.message) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Gagal memulihkan user.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal memulihkan user. Silakan coba lagi.');
                }
            });
        });
    });
</script>
