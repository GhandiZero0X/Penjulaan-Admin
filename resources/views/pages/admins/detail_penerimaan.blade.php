@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('penerimaan.index') }}" class="btn btn-success mb-3">Back</a>
                <h4 class="card-title">Detail Penerimaan Barang</h4>
                <div class="table-responsive mb-3" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Penerimaan</th>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Status Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">{{ $detailPenerimaan->idpenerimaan }}</td>
                                <td>{{ $detailPenerimaan->created_at }}</td>
                                <td>{{ $detailPenerimaan->username }}</td>
                                <td style="text-align: center;">
                                    {{ $detailPenerimaan->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="card-title">Detail Penerimaan Barang</h4>
                <div class="table-responsive pt-1" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Detail Penerimaan</th>
                                <th>Nama Barang</th>
                                <th>Jumlah Diterima</th>
                                <th>Harga Satuan Diterima</th>
                                <th>Subtotal Diterima</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your detail penerimaan data --}}
                            @foreach ($detailBarang as $barang)
                                <tr style="text-align: center;">
                                    <td>{{ $barang->iddetail_penerimaan }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->jumlah_terima }}</td>
                                    <td>{{ $barang->harga_satuan_terima }}</td>
                                    <td>{{ $barang->sub_total_terima }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
