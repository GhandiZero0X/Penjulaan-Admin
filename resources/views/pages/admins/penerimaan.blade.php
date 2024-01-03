@extends('layouts.appAdmin')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pengadaan</h4>
                <div class="table-responsive pt-3" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Pengadaan</th>
                                <th>Tanggal</th>
                                <th>User</th>
                                <th>Nama Vendor</th>
                                <th>Sub Total</th>
                                <th>Ppn</th>
                                <th>Total Nilai</th>
                                <th>Status Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through your Penerimaan data --}}
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
                                            <button data-idpengadaan="{{ $item->idpengadaan }}"
                                                data-iduser="{{ $item->idvendor }}"
                                                class="btn btn-warning btn-sm terimaBarang">
                                                <i class="typcn typcn-pencil"></i> Terima Barang
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h4 class="card-title">Daftar Penerimaan Barang</h4>
                <div class="table-responsive pt-3" style="max-width: 100%;">
                    <table class="table table-bordered">
                        <thead>
                            <tr style="text-align: center;">
                                <th>ID Penerimaan</th>
                                <th>Tanggal</th>
                                <th>User</th>
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
                                    <td style="text-align: center;">
                                        {{ $item->status_aktif == 1 ? 'Aktif' : 'Non-Aktif' }}
                                    </td>
                                    <td style="text-align: center;">
                                        {{-- Add your actions/buttons here --}}
                                        <div class="btn-group">
                                            <button data-idpenerimaan="{{ $item->idpenerimaan }}"
                                                class="btn btn-info btn-sm viewPenerimaan">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.terimaBarang').on('click', function() {
            var idPengadaan = $(this).data('idpengadaan');
            var idUser = $(this).data('iduser');

            // Add the CSRF token to the headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Use the absolute path for the URL
            $.ajax({
                type: 'POST',
                url: '{{ route('penerimaan.barang') }}',
                data: {
                    idUser: idUser,
                    idPengadaan: idPengadaan,
                },
                success: function(response) {
                    console.log(response);
                    location.reload();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });

        document.querySelectorAll('.viewPenerimaan').forEach(button => {
            button.addEventListener('click', function() {
                // Ambil ID pengadaan dari data attribute
                const idpenerimaan = this.getAttribute('data-idpenerimaan');

                // Redirect ke halaman detail pengadaan
                window.location.href = `/penerimaan/${idpenerimaan}/detail`;
            });
        });
    });
</script>
