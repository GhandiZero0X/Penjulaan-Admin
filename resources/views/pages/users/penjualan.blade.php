@extends('layouts.appKasir')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Penjualan Barang</h4>
                <div class="table-responsive pt-3" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Penjualan</th>
                                <th>Nama User</th>
                                <th>Tanggal</th>
                                <th>Sub total nilai</th>
                                <th>ppn</th>
                                <th>Margin Penjualan</th>
                                <th>Total Nilai</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your Penjualan data --}}
                            @foreach ($penjualan as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $item->idpenjualan }}</td>
                                    <td>{{ $item->nama_user }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->subtotal_nilai }}</td>
                                    <td>{{ $item->ppn }}</td>
                                    <td>{{ $item->margin_penjualan }}</td>
                                    <td>{{ $item->total_nilai }}</td>
                                    <td style="text-align: center;">
                                        {{ $item->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{-- Add your actions/buttons here --}}
                                        <div class="btn-group">
                                            <button data-id="{{ $item->idpenjualan }}"
                                                class="btn btn-info btn-sm viewPenjualan">
                                                <i class="typcn typcn-eye"></i> Detail
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
