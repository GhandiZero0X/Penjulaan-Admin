@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Penerimaan Barang</h4>
                <div class="table-responsive pt-3" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Penerimaan</th>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Vendor</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your Penerimaan data --}}
                            @foreach ($penerimaan as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $item->idpenerimaan }}</td>
                                    <td>{{ $item->timestamp }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->nama_vendor }}</td>
                                    <td style="text-align: center;">
                                        {{ $item->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{-- Add your actions/buttons here --}}
                                        <div class="btn-group">
                                            <button data-id="{{ $item->idpenerimaan }}"
                                                class="btn btn-info btn-sm viewPenerimaan">
                                                <i class="typcn typcn-eye"></i> Detail
                                            </button>
                                            <button data-id="{{ $item->idpenerimaan }}"
                                                class="btn btn-warning btn-sm editPenerimaan">
                                                <i class="typcn typcn-pencil"></i> Edit
                                            </button>
                                            <button data-id="{{ $item->idpenerimaan }}"
                                                class="btn btn-danger btn-sm deletePenerimaan">
                                                <i class="typcn typcn-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
