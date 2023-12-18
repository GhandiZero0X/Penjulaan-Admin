@extends('layouts.appKasir')

@section('content')
    <div class="container mt-5">
        <h2>Form Barang</h2>
        <form method="POST" id="barangForm">
            @csrf
            <div class="form-group">
                <label for="namaBarang">Nama Barang :</label>
                <input type="text" class="form-control" id="namaBarang" placeholder="Masukkan nama barang">
            </div>
            {{-- <div class="form-group">
                <label for="jumlahKeluar">Jumlah Keluar :</label>
                <input type="number" class="form-control" id="jumlahKeluar" placeholder="Masukkan jumlah keluar">
            </div> --}}
            <button type="button" class="btn btn-primary mt-3" id="cariBarangBtn">Cari Barang</button>
        </form>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cariBarangBtn').on('click', function() {
            var formData = $('#barangForm').serialize();
            var el = document.getElementById('namaBarang')

            console.log(formData);

            $.ajax({
                url: "/Home-kasir/caribarang",
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    formData: formData,
                    barang: el.value
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error(error);
                    alert('Gagal cari barang. Silakan coba lagi.');
                }
            });
        });
    });
</script>
