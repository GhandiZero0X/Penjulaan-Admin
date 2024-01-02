@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Retur Barang</h4>
                <div class="table-responsive pt-3" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Retur</th>
                                <th>Tanggal</th>
                                <th>ID Penerima</th>
                                <th>ID User</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your Retur data --}}
                            @foreach ($retur as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $item->idretur }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->idpenerima }}</td>
                                    <td>{{ $item->iduser }}</td>
                                    <td style="text-align: center;">
                                        {{ $item->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{-- Add your actions/buttons here --}}
                                        <div class="btn-group">
                                            <button data-id="{{ $item->idretur }}"
                                                class="btn btn-info btn-sm viewRetur">
                                                <i class="typcn typcn-eye"></i> Detail
                                            </button>
                                            <button data-id="{{ $item->idretur }}"
                                                class="btn btn-warning btn-sm editRetur">
                                                <i class="typcn typcn-pencil"></i> Edit
                                            </button>
                                            <button data-id="{{ $item->idretur }}"
                                                class="btn btn-danger btn-sm deleteRetur">
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
