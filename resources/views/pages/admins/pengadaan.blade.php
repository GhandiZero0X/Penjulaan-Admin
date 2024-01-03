@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Daftar Pengadaan Barang</h4>
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
                        <div class="card-body border p-3" id="createPengadaanForm"
                            style="display: none; margin-top: 10px; background-color: #fffefe; border-radius: 5px;">
                            <h3 class="card-title">Tambah Pengadaan Barang</h3>
                            <form id="pengadaanForm" action="{{ route('pengadaan.create') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="idUser">ID User</label>
                                    <select class="form-control" id="idUser" name="idUser">
                                        {{-- Option dari daftar user --}}
                                        @foreach ($users as $user)
                                            <option value="{{ $user->iduser }}">{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="idVendor">Vendor</label>
                                    <select class="form-control" id="idVendor" name="idVendor">
                                        {{-- Option dari daftar vendor --}}
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->idvendor }}">{{ $vendor->nama_vendor }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="namaBarang">Nama Barang</label>
                                    <select class="form-control" id="namaBarang" name="namaBarang">
                                        {{-- Option dari daftar barang --}}
                                        @foreach ($barangs as $barang)
                                            <option value="{{ $barang->nama }}">{{ $barang->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Barang</label>
                                    <input type="text" class="form-control" id="jumlah" name="jumlah">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga Barang</label>
                                    <input type="text" class="form-control" id="harga" name="harga">
                                </div>
                                <div class="form-group">
                                    <label for="ppn">PPN</label>
                                    <input type="text" class="form-control" id="ppn" name="ppn">
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive pt-3" style="max-width: 100%;">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your Pengadaan data --}}
                            @foreach ($pengadaan as $item)
                                <tr>
                                    <td style="text-align: center;">{{ $item->idpengadaan }}</td>
                                    <td>{{ $item->timestamp }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->nama_vendor }}</td>
                                    <td>{{ $item->subtotal_nilai }}</td>
                                    <td>{{ $item->ppn }}</td>
                                    <td>{{ $item->total_nilai }}</td>
                                    <td style="text-align: center;">
                                        {{ $item->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{-- Add your actions/buttons here --}}
                                        <div class="btn-group">
                                            <button data-id="{{ $item->idpengadaan }}"
                                                class="btn btn-info btn-sm viewPengadaan">
                                                <i class="typcn typcn-eye"></i> Detail
                                            </button>
                                            <button data-id="{{ $item->idpengadaan }}"
                                                class="btn btn-warning btn-sm editPengadaan">
                                                <i class="typcn typcn-pencil"></i> Edit
                                            </button>
                                            <button data-id="{{ $item->idpengadaan }}"
                                                class="btn btn-danger btn-sm deletePengadaan">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#addPengadaanButton').click(function() {
            let form = $('#createPengadaanForm');

            if (form.is(':visible')) {
                form.slideUp();
            } else {
                form.slideDown();
            }
        });

        document.querySelectorAll('.viewPengadaan').forEach(button => {
            button.addEventListener('click', function() {
                // Ambil ID pengadaan dari data attribute
                const idPengadaan = this.getAttribute('data-id');

                // Redirect ke halaman detail pengadaan
                window.location.href = `/pengadaan/${idPengadaan}/detail`;
            });
        });
    });
</script>
