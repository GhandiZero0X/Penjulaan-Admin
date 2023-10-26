@extends('layouts.appAdmin')

@section('content')
    <!-- Bagian Tabel Barang -->
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Barang</h4>
                <div class="row">
                    <div class="col-md-6">
                        <button id="addBarangButton" class="btn btn-success btn-sm rounded">
                            <i class="typcn typcn-plus"></i> Tambah Barang
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
                        <div class="card-body border p-3" id="createBarangForm"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title">Tambah Barang Baru</h3>
                            <form id="barangForm" action="{{ route('barang.create') }}" method="POST">
                                @csrf
                                <div class="form-group d-flex">
                                    <label for="jenis" class="mr-2">Jenis</label>
                                    <input type="text" class="form-control bold" id="jenis" name="jenis"
                                        style="width: 60%; height: 20px;">
                                    <button type="submit" class="btn btn-success btn-sm ml-4"
                                        style="width: auto;">Simpan</button>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="nama" class="mr-2">Nama</label>
                                    <input type="text" class="form-control bold" id="nama" name="nama"
                                        style="width: 60%; height: 20px;">
                                </div>
                                <div class="form-group d-flex">
                                    <label for="idsatuan" class="mr-2">Satuan</label>
                                    <select class="form-control" id="idsatuan" name="idsatuan" style="width: 60%;">
                                        {{-- Option dari daftar satuan --}}
                                        @foreach ($satuan as $s)
                                            <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="harga" class="mr-2">Harga</label>
                                    <input type="text" class="form-control bold" id="harga" name="harga"
                                        style="width: 60%; height: 20px;">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body border p-3" id="tampil-history-hapus"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title" id="historyDeleteModalLabel">History Hapus Barang</h3>
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="softDeletedBarang" style="text-align: center;">

                                </tbody>
                            </table>
                            <button type="button" class="btn btn-sm btn-secondary mt-2" data-dismiss="modal"
                                style="width: auto; text-align: center;">Tutup</button>
                        </div>
                    </div>
                </div>

                <!-- Tabel Daftar Barang -->
                <div class="table-responsive pt-3" style="max-width: 90%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID</th>
                                <th>Jenis</th>
                                <th>Nama Barang</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Menampilkan data barang --}}
                            @foreach ($barang as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $item->idbarang }}</td>
                                    <td style="text-align: center;">{{ $item->jenis }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td style="text-align: center;">{{ $item->nama_satuan }}</td>
                                    <td>{{ $item->harga }}</td>
                                    <td style="text-align: center;">{{ $item->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                    </td>
                                    <td style="text-align: center;">
                                        <button data-id="{{ $item->idbarang }}" class="btn btn-warning btn-sm editBarang">
                                            <i class="typcn typcn-pencil"></i> Edit
                                        </button>
                                        <button data-id="{{ $item->idbarang }}" class="btn btn-danger btn-sm deleteBarang">
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

    <!-- Edit Barang Form -->
    <div class="card-body border p-3" id="editBarangFormRow" style="display: none;">
        <form id="editBarangForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="edit_barang_id" id="edit_barang_id" value="">
            <div class="form-group">
                <label for="edit_jenis">Jenis</label>
                <input type="text" class="form-control" name="edit_jenis" id="edit_jenis">
            </div>
            <div class="form-group">
                <label for="edit_nama">Nama Barang</label>
                <input type="text" class="form-control" name="edit_nama" id="edit_nama">
            </div>
            <div class="form-group">
                <label for="edit_idsatuan">Satuan</label>
                <select class="form-control" name="edit_idsatuan" id="edit_idsatuan">
                    {{-- Option dari daftar satuan --}}
                    @foreach ($satuan as $s)
                        <option value="{{ $s->idsatuan }}">{{ $s->nama_satuan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="edit_harga">Harga</label>
                <input type="text" class="form-control" name="edit_harga" id="edit_harga">
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success btn-sm mr-2">Simpan</button>
                <button type="button" id="cancelEditBarang" class="btn btn-secondary btn-sm">Batal</button>
            </div>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tombol "Tambah Barang" diklik
        $('#addBarangButton').click(function() {
            let form = $('#createBarangForm');

            if (form.is(':visible')) {
                form.slideUp();
            } else {
                form.slideDown();
            }
        });

        // Form "Create Barang" disubmit
        $('#barangForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            // Kirim data form ke server melalui AJAX
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Sembunyikan form setelah data terkirim
                    $('#createBarangForm').slideUp();

                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        // Tambahkan barang baru ke tabel jika berhasil disimpan
                        var newRow = '<tr>';
                        newRow += '<td>' + response.idbarang + '</td>';
                        newRow += '<td>' + response.jenis + '</td>';
                        newRow += '<td>' + response.nama + '</td>';
                        newRow += '<td>' + response.nama_satuan + '</td>';
                        newRow += '<td>' + response.harga + '</td>';
                        newRow += '<td>Aktif</td>';
                        newRow += '<td style="text-align: center;">';
                        newRow += '<button data-id="' + response.idbarang +
                            '" class="btn btn-warning btn-sm editBarang"><i class="typcn typcn-pencil"></i> Edit</button>';
                        newRow += '<button data-id="' + response.idbarang +
                            '" class="btn btn-danger btn-sm deleteBarang"><i class="typcn typcn-trash"></i> Hapus</button>';
                        newRow += '</td></tr>';
                        $('table tbody').append(newRow);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal menambahkan barang. Silakan coba lagi.');
                }
            });
        });

        // Delete Barang
        $('table').on('click', '.deleteBarang', function() {
            var deleteButton = $(this);
            var barangId = deleteButton.data('id');

            if (confirm('Apakah Anda yakin ingin menghapus barang ini?')) {
                deleteButton.closest('tr').remove();

                $.ajax({
                    url: '/barang/' + barangId + '/softdelete',
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert('Barang dihapus (soft delete) dengan sukses.');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Gagal menghapus barang. Silakan coba lagi.');
                    }
                });
            }
        });

        // Edit Barang
        $('table').on('click', '.editBarang', function() {
            var barangId = $(this).data('id');
            var barangJenis = $(this).closest('tr').find('td:nth-child(2)').text();
            var barangNama = $(this).closest('tr').find('td:nth-child(3)').text();
            var barangSatuan = $(this).closest('tr').find('td:nth-child(4)').text();
            var barangHarga = $(this).closest('tr').find('td:nth-child(5)').text();

            $('#edit_barang_id').val(barangId);
            $('#edit_jenis').val(barangJenis);
            $('#edit_nama').val(barangNama);
            $('#edit_idsatuan').val(barangSatuan);
            $('#edit_harga').val(barangHarga);

            $(this).hide();
            $(this).closest('tr').after($('#editBarangFormRow'));

            $('#editBarangFormRow').slideDown();
        });

        // Batal mengedit Barang
        $('#cancelEditBarang').click(function() {
            $('#editBarangFormRow').slideUp(function() {
                $(this).prev('tr').find('.editBarang').show();
            });
        });

        // Form submission untuk mengedit Barang
        $('#editBarangForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var barangId = $('#edit_barang_id').val();

            $.ajax({
                url: '/barang/' + barangId,
                type: 'PUT',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#editBarangFormRow').slideUp(function() {
                        $(this).prev('tr').find('.editBarang').show();
                    });

                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        $('td[data-barang-id="' + barangId + '"]').text(response.nama);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal mengedit Barang. Silakan coba lagi.');
                }
            });
        });

        // History Hapus
        $('#historyDeleteButton').click(function() {
            // Bersihkan daftar "softDeletedBarang" sebelum menambahkan yang baru
            $('#softDeletedBarang').empty();

            // Ambil data barang yang dihapus secara lunak dari server (misalnya melalui Ajax)
            $.ajax({
                url: '/soft-deleted-barang',
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(function(barang) {
                            var row = '<tr>' +
                                '<td>' + barang.nama + '</td>' +
                                '<td>' + barang.nama_satuan + '</td>' +
                                '<td><button data-id="' + barang.idbarang +
                                '" class="btn btn-sm btn-success restoreBarang">Pulihkan</button></td>' +
                                '</tr>';
                            $('#softDeletedBarang').append(row);
                        });

                        // Animasikan efek slide ke bawah
                        $('#softDeletedBarang').slideDown();

                        // Aktifkan card dengan efek slide ke bawah
                        $('#tampil-history-hapus').slideDown(); // Menampilkan card
                    } else {
                        alert('Tidak ada barang yang dihapus secara lunak.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal mengambil data history hapus barang. Silakan coba lagi.');
                }
            });
        });

        // Menutup list history hapus barang
        $('#tampil-history-hapus .btn-secondary').click(function() {
            $('#softDeletedBarang').slideUp(); // Efek slide ke atas
            $('#tampil-history-hapus').slideUp(); // Efek slide ke atas
        });

        // Perbarui pulihkan Barang
        $(document).on('click', '.restoreBarang', function() {
            var barangId = $(this).data('id');

            // Dapatkan _token CSRF dari meta-tag
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            // Lakukan pemulihan barang (misalnya melalui Ajax) dengan menyertakan _token CSRF
            $.ajax({
                url: '{{ route('barang.restore', ':id') }}'.replace(':id', barangId),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Sertakan _token CSRF dalam header
                },
                success: function(response) {
                    if (response.message) {
                        alert(response.message);
                        // Segarkan halaman setelah pemulihan berhasil
                        location.reload();
                    } else {
                        alert('Gagal memulihkan barang.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Gagal memulihkan barang. Silakan coba lagi.');
                }
            });
        });
    });
</script>
