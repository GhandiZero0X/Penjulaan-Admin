@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('pengadaan.index') }}" class="btn btn-success mb-3">Back</a>
                <h4 class="card-title">Pengadaan Barang</h4>
                <div class="table-responsive mb-3" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Pengadaan</th>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Vendor</th>
                                <th>Subtotal Nilai</th>
                                <th>PPN</th>
                                <th>Total Nilai</th>
                                <th>Status Aktif</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align: center;">{{ $detailPengadaan->idpengadaan }}</td>
                                <td>{{ $detailPengadaan->timestamp }}</td>
                                <td>{{ $detailPengadaan->username }}</td>
                                <td>{{ $detailPengadaan->nama_vendor }}</td>
                                <td>{{ $detailPengadaan->subtotal_nilai }}</td>
                                <td>{{ $detailPengadaan->ppn }}</td>
                                <td>{{ $detailPengadaan->total_nilai }}</td>
                                <td style="text-align: center;">
                                    {{ $detailPengadaan->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="card-title">Detail Pengadaan Barang</h4>
                <div class="row">
                    <div class="col-md-6">
                        <button id="addPengadaanButton" class="btn btn-success btn-sm rounded">
                            <i class="typcn typcn-plus"></i> Tambah Pengadaan
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
                        <div class="card-body border p-3" id="detailPengadaanForm">
                            <h3 class="card-title">Detail Pengadaan Barang</h3>
                            <form id="detailPengadaanForm" action="{{ route('pengadaan.detail.create') }}" method="POST">
                                @csrf
                                <input type="hidden" name="idPengadaan" value="{{ $detailPengadaan->idpengadaan }}">

                                <div class="form-group">
                                    <label for="idBarang">Nama Barang</label>
                                    <select class="form-control" id="idBarang" name="idBarang">
                                        {{-- Option dari daftar barang --}}
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->idbarang }}">{{ $barang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah Barang</label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah">
                                </div>

                                <div class="form-group">
                                    <label for="hargaSatuan">Harga Satuan</label>
                                    <input type="text" class="form-control" id="hargaSatuan" name="hargaSatuan">
                                </div>

                                <button type="submit" class="btn btn-success btn-sm">Tambah Detail</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive pt-1" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>Id Detail Pengadaan</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your detail pengadaan data --}}
                            @foreach ($detailBarang as $barang)
                                <tr style="text-align: center;">
                                    <td>{{ $barang->iddetail_pengadaan }}</td>
                                    <td>{{ $barang->nama_barang }}</td>
                                    <td>{{ $barang->jumlah }}</td>
                                    <td>{{ $barang->harga_satuan }}</td>
                                    <td>{{ $barang->sub_total }}</td>
                                    <td style="text-align: center;">
                                        {{-- Add your actions/buttons here --}}
                                        <div class="btn-group">
                                            <button data-id="{{ $barang->iddetail_pengadaan }}"
                                                class="btn btn-warning btn-sm editdetailPengadaan">
                                                <i class="typcn typcn-pencil"></i> Edit
                                            </button>
                                            <button data-id="{{ $barang->iddetail_pengadaan }}"
                                                class="btn btn-danger btn-sm deletedetailPengadaan">
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
