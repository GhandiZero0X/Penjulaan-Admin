@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Vendor</h4>
                <div class="row">
                    <div class="col-md-6">
                        <button id="addSupplierButton" class="btn btn-success btn-sm rounded">
                            <i class="typcn typcn-plus"></i> Tambah Vendor
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
                        <div class="card-body border p-3" id="createSupplierForm"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title">Tambah Vendor Baru</h3>
                            <form id="supplierForm" action="{{ route('suppliers.store') }}" method="POST">
                                @csrf
                                <div class="form-group d-flex">
                                    <label for="nama_supplier" class="mr-2">Vendor</label>
                                    <input type="text" class="form-control bold" id="nama_supplier" name="nama_supplier"
                                        style="width: 60%; height: 20px;">
                                    <button type="submit" class="btn btn-success btn-sm ml-4" style="width: auto;">
                                        Simpan
                                    </button>
                                </div>
                                <div class="form-group d-flex">
                                    <label for="badan_hukum" class="mr-2">Badan Hukum</label>
                                    <input type="text" class="form-control bold" id="badan_hukum" name="badan_hukum"
                                        style="width: 60%; height: 20px;">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body border p-3" id="tampil-history-hapus"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title" id="historyDeleteModalLabel">History Hapus Vendor</h3>
                            <table class="table table-bordered table-sm">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>Nama Supplier</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="softDeletedSuppliers" style="text-align: center;">
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
                                <th>Nama Supplier</th>
                                <th>Badan Hukum</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td style="text-align: center;">{{ $supplier->idvendor }}</td>
                                    <td>{{ $supplier->nama_vendor }}</td>
                                    <td>{{ $supplier->badan_hukum }}</td>
                                    <td style="text-align: center;">{{ $supplier->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}</td>
                                    <td style="text-align: center;">
                                        <button href="javascript:void(0);" data-id="{{ $supplier->idvendor }}"
                                            class="btn btn-warning btn-sm mr-2 editSupplier">
                                            <i class="typcn typcn-pencil"></i> Edit
                                        </button>
                                        <button href="javascript:void(0);" data-id="{{ $supplier->idvendor }}"
                                            class="btn btn-danger btn-sm deleteSupplier">
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
    <div class="card-body border p-3 " id="editSupplierFormRow" style="display: none;">
        <form id="editSupplierForm" action="" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="edit_supplier_id" id="edit_supplier_id" value="">
            <div class="form-group">
                <label for="edit_nama_supplier">Nama Supplier</label>
                <input type="text" class="form-control" name="edit_nama_supplier" id="edit_nama_supplier">
            </div>
            <div class="form-group">
                <label for="edit_badan_hukum">Badan Hukum</label>
                <input type="text" class="form-control" name="edit_badan_hukum" id="edit_badan_hukum">
            </div>
            <div style="text-align: center;">
                <button type="submit" class="btn btn-success btn-sm mr-2">Simpan</button>
                <button type="button" id="cancelEditSupplier" class="btn btn-secondary btn-sm">Batal</button>
            </div>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addSupplierButton').click(function() {
            let btn = $('#addSupplierButton');
            let form = $('#createSupplierForm');

            if (form.is(':visible')) {
                form.slideUp();
            } else {
                form.slideDown();
            }
        });

        $('#supplierForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#createSupplierForm').slideUp();
                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        var newRow = '<tr>';
                        newRow += '<td>' + response.idvendor + '</td>';
                        newRow += '<td>' + response.nama_vendor + '</td>';
                        newRow += '<td>' + response.badan_hukum + '</td>';
                        newRow += '<td>Aktif</td>'; // Default status
                        newRow += '<td style="text-align: center;">';
                        newRow += '<button href="javascript:void(0);" data-id="' + response.idvendor + '" class="btn btn-warning btn-sm mr-2 editSupplier"><i class="typcn typcn-pencil"></i> Edit</button>';
                        newRow += '<button href="javascript:void(0);" data-id="' + response.idvendor + '" class="btn btn-danger btn-sm deleteSupplier"><i class="typcn typcn-trash"></i> Hapus</button>';
                        newRow += '</td></tr>';
                        $('table tbody').append(newRow);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to add Supplier. Please try again.');
                }
            });
        });

        $('.deleteSupplier').click(function() {
            var deleteButton = $(this);
            var supplierId = deleteButton.data('id');

            if (confirm('Are you sure you want to delete this Supplier?')) {
                deleteButton.closest('tr').remove();
                $.ajax({
                    url: '/suppliers/' + supplierId + '/softdelete',
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        alert('Supplier deleted (soft delete) successfully.');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Failed to delete Supplier. Please try again.');
                    }
                });
            }
        });

        $('.editSupplier').click(function() {
            var supplierId = $(this).data('id');
            var supplierName = $(this).closest('tr').find('td:nth-child(2)').text();
            var supplierLegal = $(this).closest('tr').find('td:nth-child(3)').text();

            $('#edit_supplier_id').val(supplierId);
            $('#edit_nama_supplier').val(supplierName);
            $('#edit_badan_hukum').val(supplierLegal);

            $(this).hide();
            $(this).siblings('.deleteSupplier').hide();
            $(this).closest('tr').after($('#editSupplierFormRow'));

            $('#editSupplierFormRow').slideDown();
        });

        $('#cancelEditSupplier').click(function() {
            $('#editSupplierFormRow').slideUp(function() {
                $(this).prev('tr').find('.editSupplier').show();
                $(this).prev('tr').find('.deleteSupplier').show();
            });
        });

        $('#editSupplierForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            var supplierId = $('#edit_supplier_id').val();
            $.ajax({
                url: '/suppliers/' + supplierId,
                type: 'PUT',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#editSupplierFormRow').slideUp(function() {
                        $(this).prev('tr').find('.editSupplier').show();
                        $(this).prev('tr').find('.deleteSupplier').show();
                    });

                    if (response.error) {
                        alert('Error: ' + response.error);
                    } else {
                        $('td[data-supplier-id="' + supplierId + '"]').text(response.nama_vendor);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to edit Supplier. Please try again.');
                }
            });
        });

        $('#historyDeleteButton').click(function() {
            $('#softDeletedSuppliers').empty();
            $.ajax({
                url: '/soft-deleted-suppliers',
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        response.forEach(function(supplier) {
                            var row = '<tr>' +
                                '<td>' + supplier.nama_vendor + '</td>' +
                                '<td><button data-id="' + supplier.idvendor + '" class="btn btn-sm btn-success restoreSupplier">Pulihkan</button></td>' +
                                '</tr>';
                            $('#softDeletedSuppliers').append(row);
                        });

                        $('#softDeletedSuppliers').slideDown();
                        $('#tampil-history-hapus').slideDown();
                    } else {
                        alert('No soft-deleted Supplier entries found.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to retrieve soft-deleted Supplier entries. Please try again.');
                }
            });
        });

        $('#tampil-history-hapus .btn-secondary').click(function() {
            $('#softDeletedSuppliers').slideUp();
            $('#tampil-history-hapus').slideUp();
        });

        $(document).on('click', '.restoreSupplier', function() {
            var supplierId = $(this).data('id');

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{ route('supplier.restore', ':id') }}'.replace(':id', supplierId),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.message) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert('Failed to restore Supplier.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('Failed to restore Supplier. Please try again.');
                }
            });
        });
    });
</script>
